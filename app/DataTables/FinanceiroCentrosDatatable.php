<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class FinanceiroCentrosDatatable extends Datatable
{

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => __('views.admin.cc.index.table_1_header_0'),
                'width' => '10%',
                'className' => 'text-center',
            ],
            'nome' => [
                'title' => __('views.admin.cc.index.table_1_header_1'),
                'width' => '60%'
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
            ],
            'order' => [['1', 'asc']],
        ];
    }

    protected function getButtons()
    {
        return [];
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    public function query()
    {
        $centros = FinanceiroCentro::select('financeiro_centros.*');

        return $this->applyScopes($centros);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters());
    }
}