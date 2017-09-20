<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Movimento;
use App\MovimentoProduto;
use App\MovimentosDatatable;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MovimentosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param MovimentosDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(MovimentosDatatable $dataTable)
    {

        return $dataTable->render('admin.modulos.operacional.movimentacao.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.operacional.movimentacao.create', compact('produtos'));
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

            $movimento_input = $request->except('produto', 'quantidade');

            $movimento = Movimento::create($movimento_input);

            $produto_input['movimento_id'] = $movimento->id;

            $produtos = $request->only('produto', 'quantidade');

            foreach ($produtos['produto'] as $key => $produto) {

                if ($produto != '') {

                    $produto_input['produto_id'] = $produto;
                    $produto_input['quantidade'] = $produtos['quantidade'][$key];

                    MovimentoProduto::create($produto_input);

                }

            }
        });

        Session::flash('created', __('views.admin.flash.created'));

        return redirect(route('operacional.movimento.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimento = Movimento::findOrFail($id);

        return view('admin.modulos.operacional.movimentacao.show', compact('movimento'));
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
        Movimento::findOrFail($id)->delete();

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('operacional.movimento.index'));
    }
}
