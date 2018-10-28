<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class FiadoVendasScope implements DataTableScopeContract
{

    protected $id, $relation_1;

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

    public function __construct($id, $relation_1 = 'fiado_vendas.pessoa_id')
    {
        $this->id = $id;
        $this->relation_1 = $relation_1;
    }

    public function apply($query)
    {
        return $query->where($this->relation_1, $this->id);
    }
}
