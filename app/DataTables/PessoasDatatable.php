<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class PessoasDatatable extends Datatable
{

    protected $printPreview = 'admin.modulos.cadastro.pessoa.print';

    protected function getColumns()
    {
        return [
            'nome' => [
                'title' => __('views.admin.pessoa.index.table_header_1')
            ],
            'telefone' => [
                'title' => __('views.admin.pessoa.index.table_header_2')
            ],
            'email' => [
                'title' => __('views.admin.pessoa.index.table_header_3')
            ],
            'tipo.nome' => [
                'title' => __('views.admin.pessoa.index.table_header_4')
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
                    'copyTitle' => __('views.admin.pessoa.index.button.copiar.title'),
                    'copySuccess' => [
                        '_' => __('views.admin.pessoa.index.button.copiar.success._'),
                        '1' => __('views.admin.pessoa.index.button.copiar.success.1')
                    ]
                ]
            ],
            'initComplete' => 'admin.modulos.cadastro.pessoa.scripts.init-complete'
        ];
    }

    protected function getButtons()
    {

        return [
            [
                'extend' => 'print',
                'className' => 'form-control',
                'text' => '<i class="fa fa-print"></i> ' . __('views.admin.pessoa.index.button.imprimir')
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
        return time() . '_pessoas';
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route('cadastro.pessoa.edit', $query->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> ' . __('views.admin.pessoa.index.button.edit') . '</a>';
            })
            ->make(true);
    }

    public function query()
    {
        $pessoas = Pessoa::select('pessoas.*')->with('tipo');

        return $this->applyScopes($pessoas);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}