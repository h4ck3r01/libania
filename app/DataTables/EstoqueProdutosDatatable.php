<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class EstoqueProdutosDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.operacional.estoque.print';

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.estoque.index.table_header_0'),
                'width' => '10%',
                'className' => 'text-center',
            ],
            'produto.nome' => [
                'title' => __('views.admin.estoque.index.table_header_1')
            ],
            'produto.categoria.nome' => [
                'title' => __('views.admin.estoque.index.table_header_2')
            ],
            'movimento_entrada' => [
                'title' => __('views.admin.estoque.index.table_header_3'),
                'width' => '10%',
                'className' => 'text-center',
                'searchable' => false,
            ],
            'movimento_saida' => [
                'title' => __('views.admin.estoque.index.table_header_4'),
                'width' => '10%',
                'className' => 'text-center',
                'searchable' => false,
            ],
            'compra' => [
                'title' => __('views.admin.estoque.index.table_header_5'),
                'width' => '10%',
                'className' => 'text-center',
                'searchable' => false,
            ],
            'venda' => [
                'title' => __('views.admin.estoque.index.table_header_6'),
                'width' => '10%',
                'className' => 'text-center',
                'searchable' => false,
            ],
            'total' => [
                'title' => __('views.admin.estoque.index.table_header_7'),
                'width' => '10%',
                'className' => 'text-center',
                'searchable' => false,
            ]
        ];
    }

    protected function getParameters()
    {
        return [
            'processing' => 'false',
            'responsive' => 'true',
            'dom' => 'Bftip',
            'buttons' => $this->getButtons(),
            'language' => [
                'url' => '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json',
                'buttons' => [
                    'copyTitle' => __('views.admin.produto.index.button.copiar.title'),
                    'copySuccess' => [
                        '_' => __('views.admin.produto.index.button.copiar.success._'),
                        '1' => __('views.admin.produto.index.button.copiar.success.1')
                    ]
                ]
            ],
            'order' => [['1', 'asc']],
            'initComplete' => 'admin.modulos.operacional.estoque.scripts.init-complete',
        ];
    }

    protected function getButtons()
    {

        return [
            [
                'extend' => 'print',
                'className' => 'form-control',
                'text' => '<i class="fa fa-print"></i> ' . __('views.admin.produto.index.button.imprimir')
            ],
            [
                'extend' => 'excel',
                'className' => 'form-control',
                'text' => '<i class="fa fa-file-excel-o"></i> Excel',
            ]
        ];
    }

    protected function filename()
    {
        return time() . '_estoque';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    public function query()
    {
        $estoque = EstoqueProduto::select('estoque_produtos.*')->with('produto.categoria');

        return $this->applyScopes($estoque);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}