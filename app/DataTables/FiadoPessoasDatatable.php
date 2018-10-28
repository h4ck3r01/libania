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

class FiadoPessoasDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.financeiro.fiado.print';

    protected function getColumns()
    {
        return [
            'pessoa.nome' => [
                'title' => __('views.admin.fiado.index.table_header_0'),
                'width' => '60%'
            ],
            'data_ultimo' => [
                'title' => __('views.admin.fiado.index.table_header_1'),
                'className' => 'text-center',
                'searchable' => 'false',
                'defaultContent' => ''
            ],
            'total_ultimo' => [
                'title' => __('views.admin.fiado.index.table_header_2'),
                'className' => 'text-right',
                'width' => '10%',
                'defaultContent' => ''
            ],
            'total' => [
                'title' => __('views.admin.fiado.index.table_header_3'),
                'className' => 'text-right',
                'width' => '10%'
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
            'order' => [0, 'asc']
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
        return time() . '_fiado';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('financeiro.fiado.show', $query->id) . '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> ' . __('views.admin.fiado.index.button.show') . '</a>';
            })
            ->editColumn('data_ultimo', function ($query) {
                if ($query->data_ultimo != '')
                    return $query->data_ultimo->format('d/m/Y');
            })
            ->editColumn('total_ultimo', function ($query) {
                return parseMoney($query->total_ultimo);
            })
            ->filterColumn('total_ultimo', function ($query, $keyword) {
                $query->whereRaw("fiado_pessoas.total_ultimo like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->editColumn('total', function ($query) {
                return parseMoney($query->total);
            })
            ->filterColumn('total', function ($query, $keyword) {
                $query->whereRaw("fiado_pessoas.total like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    public function query()
    {
        $fiado = FiadoPessoa::select('fiado_pessoas.*')->with(['pessoa']);

        return $this->applyScopes($fiado);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}