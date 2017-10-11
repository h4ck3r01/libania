<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class FiadoVendasScope implements DataTableScopeContract
{

    protected $id, $forma_id, $relation_1, $relation_2;

    /**
     * Apply a query scope.
     *
     * @param $id
     * @param int $forma_id
     * @param string $relation_1
     * @param string $relation_2
     * @internal param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($id, $forma_id = 4, $relation_1 = 'vendas.pessoa_id', $relation_2 = 'vendas.forma_id')
    {
        $this->id = $id;
        $this->forma_id = $forma_id;
        $this->relation_1 = $relation_1;
        $this->relation_2 = $relation_2;
    }

    public function apply($query)
    {
        return $query->where($this->relation_1, $this->id)->where($this->relation_2, $this->forma_id);
    }
}
