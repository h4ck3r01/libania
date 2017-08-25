<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class ProdutosDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.cadastro.produto.print';

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.produto.index.table_header_0'),
                'width' => '10%',
            ],
            'nome' => [
                'title' => __('views.admin.produto.index.table_header_1')
            ],
            'categoria.nome' => [
                'title' => __('views.admin.produto.index.table_header_2')
            ],
            'action' => [
                'name' => 'action',
                'title' => '',
                'className' => 'text-center',
                'width' => '10%',
                'orderable' => false,
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ]
        ];
    }

    protected function getParameters()
    {
        return [
            'responsive' => 'true',
            'dom' => 'Bfrtip',
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
            'initComplete' => 'admin.modulos.cadastro.produto.scripts.init-complete'
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
        return time() . '_produtos';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('cadastro.produto.edit', $query->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> ' . __('views.admin.produto.index.button.edit') . '</a>';
            })
            ->make(true);
    }

    public function query()
    {
        $produtos = Produto::select('produtos.*')->with('categoria');

        return $this->applyScopes($produtos);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}