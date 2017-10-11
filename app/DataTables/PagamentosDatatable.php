<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class PagamentosDatatable extends Datatable
{
    
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('vencimento', function ($query) {
                return $query->vencimento->format('d/m/Y');
            })
            ->editColumn('pagamentos.total', function($query){
                return parseMoney($query->total);
            })
            ->filterColumn('pagamentos.total', function($query, $keyword) {
                $query->whereRaw("pagamentos.total like ?", ["%". formatMoney($keyword) . "%"]);
            })
            ->with('sum', $this->sum())
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $pagamentos = Pagamento::select('pagamentos.*')->with(['categoria', 'pessoa']);

        return $this->applyScopes($pagamentos);
    }

    public function sum()
    {
        $total = Pagamento::select('total');

        $sum = $this->applyScopes($total);

        return $sum->sum('total');
    }

}