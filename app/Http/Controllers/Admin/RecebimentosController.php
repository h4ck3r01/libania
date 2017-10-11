<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\RecebimentosScope;
use App\FinanceiroCategoria;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\RecebimentosDatatable;
use App\VendaForma;
use Illuminate\Http\Request;

class RecebimentosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param RecebimentosDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(RecebimentosDatatable $dataTable)
    {
        $categorias = FinanceiroCategoria::where('fluxo', 1)->orderBy('nome')->pluck('nome', 'id')->all();

        $pessoas = Pessoa::where('tipo_id', 1)->orderBy('nome')->pluck('nome', 'id')->all();

        $formas = VendaForma::orderBy('nome')->pluck('nome', 'id')->all();

        return $dataTable->render('admin.modulos.financeiro.recebimentos.index', compact('categorias', 'pessoas', 'formas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param RecebimentosDatatable $dataTable
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @internal param $id
     */
    public function getDataTable(Request $request, RecebimentosDatatable $dataTable)
    {
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $categoria = $request->categoria;
        $cliente = $request->cliente;
        $forma = $request->forma;

        return $dataTable->addScope(new RecebimentosScope($data_inicial, $data_final, $categoria, $cliente, $forma))->render('admin.modulos.financeiro.recebimentos.index');
    }
}
