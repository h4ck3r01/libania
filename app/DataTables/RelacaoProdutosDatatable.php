<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Services\DataTable;

class RelacaoProdutosDatatable extends Datatable
{

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_0'),
            ],
            'nome' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_1')
            ],
            'categoria' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_2')
            ],
            'venda_quantidade' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_3')
            ],
            'venda_total' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_4')
            ],
            'compra_quantidade' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_5')
            ],
            'compra_total' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_6')
            ],
            'lucro' => [
                'title' => __('views.admin.relacao_produtos.index.table_header_7')
            ]
        ];
    }

    protected function filename()
    {
        return time() . '_relacao_produtos';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('venda_total', function ($query) {

                ($query->venda_total != null) ? $total = parseMoney($query->venda_total) : $total = '0,00';

                return $total;
            })
            ->editColumn('compra_total', function ($query) {

                ($query->compra_total != null) ? $total = parseMoney($query->compra_total) : $total = '0,00';

                return $total;
            })
            ->editColumn('lucro', function ($query) {

                ($query->lucro != null) ? $total = parseMoney($query->lucro) : $total = '0,00';

                return $total;
            })
            ->make(true);
    }

    public function query()
    {

        $query = Produtos::leftJoin(DB::raw('(SELECT venda_produtos.* FROM venda_produtos, vendas where venda_produtos.produto_id = vendas.id) venda_produtos'),
            function ($join) {
                $join->on('venda_produtos.produto_id', '=', 'produtos.id');
            });

        $query = DB::table('produtos')
            ->select(DB::raw('produtos.id,
                        produtos.nome,
                        produto_categorias.nome AS categoria'))
            ->leftJoin(DB::raw('(SELECT venda_produtos.* FROM venda_produtos, vendas where venda_produtos.produto_id = vendas.id) venda_produtos'),
                function ($join) {
                    $join->on('venda_produtos.produto_id', '=', 'produtos.id');
                })
            ->join('produto_categorias', 'produto_categorias.id', 'produtos.categoria_id')
            ->groupBy(['produtos.id', 'produtos.nome', 'produto_categorias.nome']);

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns());
    }
}