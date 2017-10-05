<?php

namespace App\Http\Controllers\Admin;

use App\FinanceiroCentro;
use App\FinanceiroCentrosDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FinanceiroCentrosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param FinanceiroCentrosDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(FinanceiroCentrosDataTable $dataTable)
    {
        return $dataTable->render('admin.modulos.financeiro.centros_custo.index');
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
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FinanceiroCentro::create($request->all());

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.cc.create.success.message')];
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
        FinanceiroCentro::findOrFail($id)->update($request->all());

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.cc.update.success.message')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        try {
            FinanceiroCentro::findOrFail($id)->delete();

            $title = __('views.admin.notify.success');
            $message = __('views.admin.cc.destroy.success.message');
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

    public function resumo()
    {

        return '';

    }
}
