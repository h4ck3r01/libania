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

class FiadoRecebimentosDatatable extends Datatable
{

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('data', function ($query) {
                return $query->data->format('d/m/Y');
            })
            ->editColumn('recebimentos.total', function ($query) {
                return parseMoney($query->total);
            })
            ->filterColumn('recebimentos.total', function ($query, $keyword) {
                $query->whereRaw("recebimentos.total like ?", ["%" . formatMoney($keyword) . "%"]);
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('financeiro.ajax.table-fiado-recebimentos.destroy', $query->id) . '" class="btn btn-xs btn-danger"><i class="fa fa-times-circle fa-fw"></i> ' . __('views.admin.fiado.index.button.destroy') . '</a>';
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $recebimentos = Recebimento::select('recebimentos.*')->with(['forma']);

        return $this->applyScopes($recebimentos);
    }
}