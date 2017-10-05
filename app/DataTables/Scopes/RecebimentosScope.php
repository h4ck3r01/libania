<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class RecebimentosScope implements DataTableScopeContract
{

    protected $data_inicial, $data_final, $relation;

    /**
     * Apply a query scope.
     *
     * @param string $relation
     * @param $data_inicial
     * @param $data_final
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($data_inicial, $data_final, $relation = 'recebimentos.data')
    {
        $this->relation = $relation;
        $this->data_inicial = $data_inicial;
        $this->data_final = $data_final;
    }


    public function apply($query)
    {
        return $query->whereBetween($this->relation, array($this->data_inicial, $this->data_final));
    }
}
