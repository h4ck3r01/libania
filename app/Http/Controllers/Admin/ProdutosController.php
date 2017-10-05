<?php

namespace App\Http\Controllers\Admin;

use App\EstoqueProduto;
use App\Http\Controllers\Controller;
use App\Produto;
use App\ProdutoCategoria;
use App\ProdutosDatatable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProdutosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param ProdutosDatatable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ProdutosDatatable $dataTable)
    {
        $categorias = ProdutoCategoria::orderBy('nome')->pluck('nome', 'nome')->all();

        return $dataTable->render('admin.modulos.cadastro.produto.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = ProdutoCategoria::orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.cadastro.produto.create', compact('categorias'));
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

            if(!is_numeric($request->categoria_id)) {

                $categoria = ProdutoCategoria::create(['nome' => $request->categoria_id]);

                $request['categoria_id'] = $categoria->id;
            }

            $produto = Produto::create($request->all());

            $produto_id = $produto->id;

            EstoqueProduto::create(['produto_id' => $produto_id]);

            return $produto_id;

        });

        Session::flash('created', __('views.admin.flash.created'));

        return redirect(route('cadastro.produto.index'));

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
        $produto = Produto::findOrFail($id);

        $categorias = ProdutoCategoria::orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.cadastro.produto.edit', compact('produto', 'categorias'));
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
        if(!is_numeric($request->categoria_id)) {

            $categoria = ProdutoCategoria::create(['nome' => $request->categoria_id]);

            $request['categoria_id'] = $categoria->id;
        }

        $input = $this->getInput($request);

        Produto::findOrFail($id)->update($input);

        Session::flash('updated', __('views.admin.flash.updated'));

        return redirect(route('cadastro.produto.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            Produto::findOrFail($id)->delete();

            Session::flash('deleted', __('views.admin.flash.deleted'));

        } catch (QueryException $e) {

            if ($e->getCode() == "23000") {
                Session::flash('constraint', __('views.admin.flash.constraint'));
            }
        }

        return redirect(route('cadastro.produto.index'));

    }

    protected function getInput($request)
    {

        $input = $request->all();

        if (!is_numeric($request->categoria_id)) {

            $categoria = ProdutoCategoria::whereNome($request->categoria_id)->get();

            if (!$categoria->count()) {

                $categoria = ProdutoCategoria::create(['nome' => $request->categoria_id]);

                $input['categoria_id'] = $categoria->id;
            }

        }

        return $input;
    }

    public function categoriaDestroy(Request $request)
    {
        try {
            ProdutoCategoria::findOrFail($request->id)->delete();

            return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.produto.categoria.delete.success')];

        } catch (QueryException $e) {

            if ($e->getCode() == "23000") {
                return ['status' => 'error', 'title' => __('views.admin.notify.error'), 'message' => __('views.admin.produto.categoria.delete.error_0')];
            }
        }
    }
}
