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

class FiadoVendasDatatable extends Datatable
{

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('data', function ($query) {
                return $query->data->format('d/m/Y');
            })
            ->editColumn('total', function ($query) {
                return parseMoney($query->total);
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $vendas = FiadoVendas::select('fiado_vendas.*');

        return $this->applyScopes($vendas);
    }
}