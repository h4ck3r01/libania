<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class RelacaoVendasDatatable extends Datatable
{

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_0'),
            ],
            'nome' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_1')
            ],
            'categoria.nome' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_2')
            ],
            'vendas.venda.data' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_3')
            ],
            'vendas.quantidade' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_4')
            ],
            'vendas.total' => [
                'title' => __('views.admin.relacao_vendas.index.table_header_5')
            ]
        ];
    }

    protected function filename()
    {
        return time() . '_relacao_vendas';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('vendas.venda.data', function ($query) {

                ($query['vendas']['venda']['data'] != null) ? $date = $query['vendas']['venda']['data']->format('d/m/Y') : $date = '';

                return $date;
            })
            ->editColumn('vendas.total', function ($query) {

                ($query['vendas']['total'] != null) ? $total = parseMoney($query['vendas']['total']) : $total = '0,00';

                return $total;
            })
            ->filterColumn('vendas.total', function ($query, $keyword) {
                $query->whereRaw("vendas.total like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    public function query()
    {
        $venda = Produto::join('venda_produtos', 'venda_produtos.produto_id', 'produtos.id')
                    ->join('vendas', 'venda_produtos.venda_id', 'vendas.id')
                    ->select('produtos.*')
                    ->with('vendas','categoria');

        return $this->applyScopes($venda);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns());
    }
}