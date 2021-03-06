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

            $estoque = new EstoqueProdutosController();

            foreach ($produtos['produto'] as $key => $produto) {

                if ($produto != '') {

                    $produto_input['produto_id'] = $produto;
                    $produto_input['quantidade'] = $produtos['quantidade'][$key];

                    MovimentoProduto::create($produto_input);

                    if ($movimento_input['fluxo'] == 1) {
                        $estoque->movimento_entrada($produto_input['produto_id'], $produto_input['quantidade'], 'insert');
                    } else if ($movimento_input['fluxo'] == 2) {
                        $estoque->movimento_saida($produto_input['produto_id'], $produto_input['quantidade'], 'insert');
                    }

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
        $movimento = Movimento::findOrFail($id);

        $produtos = Produto::orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.operacional.movimentacao.edit', compact('movimento', 'produtos'));
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
        DB::transaction(function () use ($request, $id) {

            $movimento = Movimento::findOrFail($id);

            $movimento_produtos = MovimentoProduto::where('movimento_id', $id);

            $produtos = $movimento_produtos->get();

            if ($produtos->count() > 0) {

                $estoque = new EstoqueProdutosController();

                foreach ($produtos as $produto) {

                    if ($movimento->fluxo == __('views.admin.movimento.fluxo_1')) {
                        $estoque->movimento_entrada($produto['produto_id'], $produto['quantidade'], 'delete');
                    } else if ($movimento->fluxo == __('views.admin.movimento.fluxo_2')) {
                        $estoque->movimento_saida($produto['produto_id'], $produto['quantidade'], 'delete');
                    }

                }
            }

            $movimento_input = $request->except('produto', 'quantidade');

            $movimento->update($movimento_input);

            $movimento_produtos->delete();

            $produto_input['movimento_id'] = $movimento->id;

            $produtos = $request->only('produto', 'quantidade');

            $estoque = new EstoqueProdutosController();

            foreach ($produtos['produto'] as $key => $produto) {

                if ($produto != '') {

                    $produto_input['produto_id'] = $produto;
                    $produto_input['quantidade'] = $produtos['quantidade'][$key];

                    MovimentoProduto::create($produto_input);

                    if ($movimento_input['fluxo'] == 1) {
                        $estoque->movimento_entrada($produto_input['produto_id'], $produto_input['quantidade'], 'insert');
                    } else if ($movimento_input['fluxo'] == 2) {
                        $estoque->movimento_saida($produto_input['produto_id'], $produto_input['quantidade'], 'insert');
                    }

                }

            }
        });

        Session::flash('updated', __('views.admin.flash.updated'));

        return redirect(route('operacional.movimento.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::transaction(function () use ($id) {

            $movimento = Movimento::findOrFail($id);

            $movimento_produtos = MovimentoProduto::where('movimento_id', $id);

            $produtos = $movimento_produtos->get();

            if ($produtos->count() > 0) {

                $estoque = new EstoqueProdutosController();

                foreach ($produtos as $produto) {

                    if ($movimento->fluxo == __('views.admin.movimento.fluxo_1')) {
                        $estoque->movimento_entrada($produto['produto_id'], $produto['quantidade'], 'delete');
                    } else if ($movimento->fluxo == __('views.admin.movimento.fluxo_2')) {
                        $estoque->movimento_saida($produto['produto_id'], $produto['quantidade'], 'delete');
                    }

                }
            }

            $movimento_produtos->delete();

            $movimento->delete();
        });

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('operacional.movimento.index'));
    }
}
