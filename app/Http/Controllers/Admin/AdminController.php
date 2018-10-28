<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\RelacaoProdutosScope;
use App\DataTables\Scopes\RelacaoVendasScope;
use App\Http\Controllers\Controller;
use App\ProdutoCategoria;
use App\RelacaoProdutosDatatable;
use App\RelacaoVendasDatatable;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function relacaoVendas(RelacaoVendasDatatable $dataTable)
    {
        $categorias = ProdutoCategoria::orderBy('nome')->pluck('nome', 'id')->all();

        return $dataTable->render('admin.modulos.administrativo.relacao_vendas.index', compact('categorias'));
    }
    public function getRelacaoVendasDataTable(Request $request, RelacaoVendasDatatable $dataTable)
    {

        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $categoria = $request->categoria;

        return $dataTable->addScope(new RelacaoVendasScope($data_inicial, $data_final, $categoria))->render('admin.modulos.administrativo.relacao_vendas.index');
    }


    public function relacaoProdutos(RelacaoProdutosDatatable $dataTable)
    {
        $categorias = ProdutoCategoria::orderBy('nome')->pluck('nome', 'id')->all();

        return $dataTable->render('admin.modulos.administrativo.relacao_produtos.index', compact('categorias'));
    }
    public function getRelacaoProdutosDataTable(Request $request, RelacaoProdutosDatatable $dataTable)
    {

        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;
        $categoria = $request->categoria;

        return $dataTable->addScope(new RelacaoProdutosScope($data_inicial, $data_final, $categoria))->render('admin.modulos.administrativo.relacao_produtos.index');
    }

    public function balanco(BalancoDataTable $dataTable)
    {
        return $dataTable->render('admin.modulos.administrativo.balanco.index');
    }
}
