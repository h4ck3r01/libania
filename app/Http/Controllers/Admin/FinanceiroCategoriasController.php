<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\financeiroCategoriasScope;
use App\FinanceiroCategoria;
use App\FinanceiroCategoriasDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FinanceiroCategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        FinanceiroCategoria::create($request->all());

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.cc.categoria.create.success.message')];
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
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        FinanceiroCategoria::findOrFail($id)->update($request->all());

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.cc.categoria.update.success.message')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return array|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            FinanceiroCategoria::findOrFail($id)->delete();

            $title = __('views.admin.notify.success');
            $message = __('views.admin.cc.categoria.destroy.success.message');
        } catch (QueryException $exception) {

            $title = __('views.admin.notify.error');

            if ($exception->getCode() == 23000) {
                $message = __('views.admin.flash.constraint');
            } else {
                $message = __('views.admin.notify.error.message');
            }
        }

        return ['title' => $title, 'message' => $message];
    }

    /**
     * @param Request $request
     * @param FinanceiroCategoriasDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @internal param $id
     * @internal param FinanceiroCategoriasDatatable $datatable
     */
    public function getDataTable(Request $request, FinanceiroCategoriasDatatable $dataTable)
    {

        $id = $request->id;

        return $dataTable->addScope(new FinanceiroCategoriasScope($id))->render('admin.modulos.financeiro.centros_custo.index');
    }
}
