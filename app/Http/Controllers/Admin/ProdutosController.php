<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Produto;
use App\ProdutoCategoria;
use App\ProdutosDatatable;
use Illuminate\Http\Request;
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

        if (is_numeric($request->categoria_id)) {
            $produto = Produto::create($request->all());
        } else {

            $categoria = ProdutoCategoria::whereNome($request->categoria_id)->get();
            if (!$categoria->count()) {

                $categoria = ProdutoCategoria::create(['nome' => $request->categoria_id]);
            }

            $input = $request->all();

            $input['categoria_id'] = $categoria->id;

            $produto = Produto::create($input);

        }

        Session::flash('created', __('views.admin.flash.created'));

        return redirect(route('cadastro.produto.edit', $produto->id));
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
        Produto::findOrFail($id)->update($request->all());

        Session::flash('updated', __('views.admin.flash.updated'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::findOrFail($id)->delete();

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('cadastro.produto.index'));
    }
}
