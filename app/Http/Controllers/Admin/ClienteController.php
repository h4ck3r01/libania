<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;


class ClienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Cliente::all();

        return view('admin.modulos.cadastro.cliente.index', compact('clients'));
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

    public function getDatatable()
    {
        $clientes = Cliente::all();

        return Datatables::of($clientes)
            ->addColumn('action', function ($cliente) {
                return '<a href="/admin/cliente/' . $cliente->id . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.cliente.index.show') . '</a>';
            })
            ->make(true);
    }
}