<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\RecebimentosScope;
use App\FinanceiroCategoria;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\RecebimentosDatatable;
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
        $categorias = FinanceiroCategoria::where('fluxo', 1)->orderBy('nome')->pluck('nome', 'nome')->all();

        $pessoas = Pessoa::where('tipo_id', 1)->orderBy('nome')->pluck('nome', 'nome')->all();

        return $dataTable->render('admin.modulos.financeiro.recebimentos.index', compact('categorias', 'pessoas'));
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

        return $dataTable->addScope(new RecebimentosScope($data_inicial, $data_final))->render('admin.modulos.financeiro.recebimentos.index');
    }
}
