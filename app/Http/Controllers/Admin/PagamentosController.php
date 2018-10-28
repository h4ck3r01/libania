<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\FechamentoScope;
use App\DataTables\Scopes\PagamentosScope;
use App\FinanceiroCategoria;
use App\Http\Controllers\Controller;
use App\Pagamento;
use App\PagamentosDatatable;
use App\Pessoa;
use DB;
use Illuminate\Http\Request;

class PagamentosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param PagamentosDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(PagamentosDatatable $dataTable)
    {
        $categorias = FinanceiroCategoria::where('fluxo', 2)->orderBy('nome')->pluck('nome', 'id')->all();

        $pessoas = Pessoa::where('tipo_id', 2)->orderBy('nome')->pluck('nome', 'id')->all();

        return $dataTable->render('admin.modulos.financeiro.pagamentos.index', compact('categorias', 'pessoas'));
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

        DB::transaction(function () use ($request) {

            Pagamento::create($request->only('vencimento', 'categoria_id', 'pessoa_id', 'total', 'obs'));
        });

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.venda.create.success.message')];
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
     * @param Request $request
     * @param PagamentosDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getDataTable(Request $request, PagamentosDatatable $dataTable)
    {
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $categoria = $request->categoria;
        $fornecedor = $request->fornecedor;

        return $dataTable->addScope(new PagamentosScope($data_inicial, $data_final, $categoria, $fornecedor))->render('admin.modulos.financeiro.pagamentos.index');
    }

    public function getFechamentoPagamentos(Request $request, PagamentosDatatable $dataTable)
    {
        $data = $request->data;
        $relation_1 = 'pagamentos.vencimento';

        return $dataTable->addScope(new FechamentoScope($data, $relation_1))->render('admin.modulos.financeiro.fechamento.index');
    }
}
