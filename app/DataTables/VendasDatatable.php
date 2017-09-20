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

class VendasDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.operacional.venda.print';

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.venda.index.table_header_0'),
                'width' => '10%',
            ],
            'created_at' => [
                'title' => __('views.admin.venda.index.table_header_1'),
                'searchable' => 'false'
            ],
            'forma.nome' => [
                'title' => __('views.admin.venda.index.table_header_2')
            ],
            'desconto' => [
                'title' => __('views.admin.venda.index.table_header_3'),
                'className' => 'text-right'
            ],
            'total' => [
                'title' => __('views.admin.venda.index.table_header_4'),
                'className' => 'text-right'
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
                    'copyTitle' => __('views.admin.venda.index.button.copiar.title'),
                    'copySuccess' => [
                        '_' => __('views.admin.venda.index.button.copiar.success._'),
                        '1' => __('views.admin.venda.index.button.copiar.success.1')
                    ]
                ]
            ],
            'order' => [[1, 'desc']]
        ];
    }

    protected function getButtons()
    {

        return [
            [
                'extend' => 'print',
                'className' => 'form-control',
                'text' => '<i class="fa fa-print"></i> ' . __('views.admin.venda.index.button.imprimir')
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
        return time() . '_vendas';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('operacional.venda.show', $query->id) . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.venda.index.button.show') . '</a>';
            })
            ->editColumn('created_at', function($query){
                return $query->created_at->diffForHumans();
            })
            ->editColumn('desconto', function($query){
                return parseMoney($query->desconto);
            })
            ->filterColumn('desconto', function($query, $keyword) {
                $query->whereRaw("vendas.desconto like ?", ["%". formatMoney($keyword). "%"]);
            })
            ->editColumn('total', function($query){
                return parseMoney($query->total);
            })
            ->filterColumn('total', function($query, $keyword) {
                $query->whereRaw("vendas.total like ?", ["%". formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    public function query()
    {
        $venda = Venda::select('vendas.*')->with('forma');

        return $this->applyScopes($venda);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}