<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\FiadoRecebimentosScope;
use App\DataTables\Scopes\FiadoVendasScope;
use App\FiadoPessoa;
use App\FiadoRecebimentosDatatable;
use App\FiadoVendasDatatable;
use App\FiadoPessoasDatatable;
use App\Http\Controllers\Controller;
use App\Recebimento;
use App\VendaForma;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FiadoPessoasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param FiadoPessoasDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(FiadoPessoasDatatable $dataTable)
    {
        return $dataTable->render('admin.modulos.financeiro.fiado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiado = FiadoPessoa::findOrFail($id);

        $formas = VendaForma::where('id', '!=', 4)->pluck('nome', 'id')->all();

        return view('admin.modulos.financeiro.fiado.show', compact('fiado', 'formas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $total = formatMoney($request->total) - formatMoney($request->pagar);

            FiadoPessoa::findOrFail($id)->update(['total' => $total, 'total_ultimo' => $request->pagar, 'data_ultimo' => $request->data]);

            Recebimento::create(['categoria_id' => $request->categoria_id, 'pessoa_id' => $request->pessoa_id, 'data' => $request->data, 'total' => $request->pagar, 'forma_id' => $request->forma_id]);

        });

        Session::flash('updated', __('views.admin.flash.inserted'));

        return redirect(route('financeiro.fiado.show', $id));
    }

    /**
     * @param Request $request
     * @param FiadoVendasDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getVendasDataTable(Request $request, FiadoVendasDatatable $dataTable)
    {
        $id = $request->id;

        return $dataTable->addScope(new FiadoVendasScope($id))->render('admin.modulos.financeiro.fiado.show');
    }

    /**
     * @param Request $request
     * @param FiadoRecebimentosDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getRecebimentosDataTable(Request $request, FiadoRecebimentosDatatable $dataTable)
    {
        $id = $request->id;

        return $dataTable->addScope(new FiadoRecebimentosScope($id))->render('admin.modulos.financeiro.fiado.show');
    }

    public function recebimentoDestroy($id)
    {

        $recebimento = Recebimento::findOrFail($id);

        $pessoa_id = $recebimento->pessoa_id;

        $fiado = FiadoPessoa::wherePessoaId($pessoa_id)->firstOrFail();

        DB::transaction(function () use ($recebimento, $fiado) {

            $total = formatMoney($fiado->total) + formatMoney($recebimento->total);

            $fiado->update(['total' => $total]);

            $recebimento->delete();

        });

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('financeiro.fiado.show', $fiado->id));


    }
}
