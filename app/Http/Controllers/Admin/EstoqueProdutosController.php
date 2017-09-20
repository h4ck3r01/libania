<?php

namespace App\Http\Controllers\Admin;

use App\EstoqueProduto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstoqueProdutosController extends Controller
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

    public function movimento_entrada($produto_id, $quantidade, $type)
    {
        $estoque = EstoqueProduto::where('produto_id', $produto_id)->firstOrFail();

        if ($type == 'insert') {
            $movimento_quantidade = $estoque->movimento_entrada + $quantidade;
            $total_quantidade = $estoque->total + $quantidade;
        } else if ($type == 'delete') {
            $movimento_quantidade = $estoque->movimento_entrada - $quantidade;
            $total_quantidade = $estoque->total - $quantidade;
        }

        $estoque->update(['movimento_entrada' => $movimento_quantidade, 'total' => $total_quantidade]);
    }

    public function movimento_saida($produto_id, $quantidade, $type)
    {
        $estoque = EstoqueProduto::where('produto_id', $produto_id)->firstOrFail();

        if ($type == 'insert') {
            $movimento_quantidade = $estoque->movimento_saida + $quantidade;
            $total_quantidade = $estoque->total - $quantidade;
        } else if ($type == 'delete') {
            $movimento_quantidade = $estoque->movimento_saida - $quantidade;
            $total_quantidade = $estoque->total + $quantidade;
        }

        $estoque->update(['movimento_saida' => $movimento_quantidade, 'total' => $total_quantidade]);
    }

    public function compra($produto_id, $quantidade, $type)
    {
        $estoque = EstoqueProduto::where('produto_id', $produto_id)->firstOrFail();

        if ($type == 'insert') {
            $compra_quantidade = $estoque->compra + $quantidade;
            $total_quantidade = $estoque->total + $quantidade;
        } else if ($type == 'delete') {
            $compra_quantidade = $estoque->compra - $quantidade;
            $total_quantidade = $estoque->total - $quantidade;
        }

        $estoque->update(['compra' => $compra_quantidade, 'total' => $total_quantidade]);

    }

    public function venda($produto_id, $quantidade, $type)
    {
        $estoque = EstoqueProduto::where('produto_id', $produto_id)->firstOrFail();

        if ($type == 'insert') {
            $venda_quantidade = $estoque->venda + $quantidade;
            $total_quantidade = $estoque->total - $quantidade;
        } else if ($type == 'delete') {
            $venda_quantidade = $estoque->venda - $quantidade;
            $total_quantidade = $estoque->total + $quantidade;
        }

        $estoque->update(['venda' => $venda_quantidade, 'total' => $total_quantidade]);

    }
}
