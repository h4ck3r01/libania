<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class RecebimentosDatatable extends Datatable
{
    
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('data', function ($query) {
                return $query->data->format('d/m/Y');
            })
            ->editColumn('recebimentos.total', function($query){
                return parseMoney($query->total);
            })
            ->filterColumn('recebimentos.total', function($query, $keyword) {
                $query->whereRaw("recebimentos.total like ?", ["%". formatMoney($keyword) . "%"]);
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $categorias = Recebimento::select('recebimentos.*')->with(['categoria', 'pessoa']);

        return $this->applyScopes($categorias);
    }

}