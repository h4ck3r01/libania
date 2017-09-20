<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Carbon\Carbon;
use Yajra\Datatables\Services\DataTable;

class ComprasDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.operacional.compra.print';

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.compra.index.table_header_0'),
                'width' => '10%'
            ],
            'data' => [
                'title' => __('views.admin.compra.index.table_header_1'),
                'width' => '10%',
                'searchable' => false,
            ],
            'pessoa.nome' => [
                'title' => __('views.admin.compra.index.table_header_2'),
                'width' => '20%',
            ],
            'obs' => [
                'title' => __('views.admin.compra.index.table_header_3'),
                'width' => '30%',
            ],
            'total' => [
                'title' => __('views.admin.compra.index.table_header_4'),
                'width' => '10%',
                'className' => 'text-right',
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
            'dom' => 'Bftip',
            'buttons' => $this->getButtons(),
            'language' => [
                'url' => '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json',
                'buttons' => [
                    'copyTitle' => __('views.admin.compra.index.button.copiar.title'),
                    'copySuccess' => [
                        '_' => __('views.admin.compra.index.button.copiar.success._'),
                        '1' => __('views.admin.compra.index.button.copiar.success.1')
                    ]
                ]
            ],
            'order' => [['1', 'desc'], ['2', 'asc']],
            'initComplete' => 'admin.modulos.operacional.compra.scripts.init-complete'
        ];
    }

    protected function getButtons()
    {

        return [
            [
                'extend' => 'print',
                'className' => 'form-control',
                'text' => '<i class="fa fa-print"></i> ' . __('views.admin.compra.index.button.imprimir')
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
        return time() . '_compras';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('operacional.compra.show', $query->id) . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.compra.index.button.show') . '</a>';
            })
            ->editColumn('data', function ($query) {
                return $query->data->format('d/m/Y');
            })
            ->editColumn('total', function($query){
                return parseMoney($query->total);
            })
            ->filterColumn('total', function($query, $keyword) {
                $query->whereRaw("compras.total like ?", ["%". formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    public function query()
    {
        $compras = Compra::select('compras.*')->with('pessoa');

        return $this->applyScopes($compras);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}