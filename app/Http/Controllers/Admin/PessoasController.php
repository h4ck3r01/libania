<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pessoa;
use App\PessoasDatatable;
use App\PessoaTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PessoasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param PessoasDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(PessoasDatatable $dataTable)
    {
        $tipos = PessoaTipo::pluck('nome', 'nome')->all();

        return $dataTable->render('admin.modulos.cadastro.pessoa.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tipos = PessoaTipo::pluck('nome', 'id')->all();

        return view('admin.modulos.cadastro.pessoa.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pessoa::create($request->all());

        Session::flash('created', __('views.admin.flash.created'));

        return redirect(route('cadastro.pessoa.index'));
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
        $pessoa = Pessoa::findOrFail($id);

        $tipos = PessoaTipo::pluck('nome', 'id')->all();

        return view('admin.modulos.cadastro.pessoa.edit', compact( 'pessoa', 'tipos'));
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
        Pessoa::findOrFail($id)->update($request->all());

        Session::flash('updated', __('views.admin.flash.updated'));

        return redirect(route('cadastro.pessoa.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pessoa::findOrFail($id)->delete();

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('cadastro.pessoa.index'));
    }
}