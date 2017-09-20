<?php

namespace App\Http\Controllers\Admin;

use App\Compra;
use App\CompraProduto;
use App\ComprasDatatable;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ComprasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param ComprasDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ComprasDatatable $dataTable)
    {
        return $dataTable->render('admin.modulos.operacional.compra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::orderBy('nome')->pluck('nome', 'id')->all();
        $fornecedores = Pessoa::whereTipoId(2)->orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.operacional.compra.create', compact('fornecedores', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $compra_input = $request->except('produto', 'quantidade', 'preco', 'produto_total');

            $compra = Compra::create($compra_input);

            $produto_input['compra_id'] = $compra->id;

            $produtos = $request->only('produto', 'quantidade', 'preco', 'produto_total');

            foreach ($produtos['produto'] as $key => $produto) {

                if ($produto != '') {

                    $produto_input['produto_id'] = $produto;
                    $produto_input['preco'] = $produtos['preco'][$key];
                    $produto_input['quantidade'] = $produtos['quantidade'][$key];
                    $produto_input['total'] = $produtos['produto_total'][$key];

                    CompraProduto::create($produto_input);

                }

            }
        });

        Session::flash('created', __('views.admin.flash.created'));

        return redirect(route('operacional.compra.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compra = Compra::findOrFail($id);

        return view('admin.modulos.operacional.compra.show', compact('compra'));
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
        Compra::findOrFail($id)->delete();

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('operacional.compra.index'));
    }
}
