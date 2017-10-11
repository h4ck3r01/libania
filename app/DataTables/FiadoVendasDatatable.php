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
            ->editColumn('vendas.desconto', function ($query) {
                return parseMoney($query->desconto);
            })
            ->filterColumn('vendas.desconto', function ($query, $keyword) {
                $query->whereRaw("vendas.desconto like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->editColumn('vendas.total', function ($query) {
                return parseMoney($query->total);
            })
            ->filterColumn('vendas.total', function ($query, $keyword) {
                $query->whereRaw("vendas.total like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $vendas = Venda::select('vendas.*')->with(['forma']);

        return $this->applyScopes($vendas);
    }
}