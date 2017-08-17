<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class FornecedorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Fornecedor::all();

        return view('admin.modulos.cadastro.fornecedor.index', compact('suppliers'));
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
        $fornecedores = Fornecedor::select(['id', 'nome', 'telefone', 'email', 'identificador', 'cep', DB::raw('CONCAT(rua, ", ", numero, " - ", cidade, "/", estado) AS endereco')]);

        return Datatables::of($fornecedores)
            ->addColumn('action', function ($fornecedor) {
                return '<a href="/admin/fornecedor/' . $fornecedor->id . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.fornecedor.index.show') . '</a>';
            })
            ->make(true);
    }
}
