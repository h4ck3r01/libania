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

class MovimentosDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.operacional.movimentacao.print';

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.movimento.index.table_header_0'),
                'width' => '10%'
            ],
            'data' => [
                'title' => __('views.admin.movimento.index.table_header_1'),
                'width' => '10%',
                'searchable' => false,
            ],
            'fluxo' => [
                'title' => __('views.admin.movimento.index.table_header_2'),
                'width' => '10%',
                'searchable' => false,
            ],
            'obs' => [
                'title' => __('views.admin.movimento.index.table_header_3'),
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
            ],
            'order' => [['1', 'desc'], ['0', 'desc']],
            'initComplete' => 'admin.modulos.operacional.movimentacao.scripts.init-complete'
        ];
    }

    protected function getButtons()
    {

        return [
            [
                'extend' => 'print',
                'className' => 'form-control',
                'text' => '<i class="fa fa-print"></i> ' . __('views.admin.movimento.index.button.imprimir')
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
        return time() . '_movimentos';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('operacional.movimento.show', $query->id) . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.movimento.index.button.show') . '</a>';
            })
            ->editColumn('data', function ($query) {
                return $query->data->format('d/m/Y');
            })
            ->make(true);
    }

    public function query()
    {
        $movimentos = Movimento::select('movimentos.*');

        return $this->applyScopes($movimentos);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}