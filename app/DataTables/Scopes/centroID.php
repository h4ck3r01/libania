<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class centroID implements DataTableScopeContract
{

    protected $id;

    protected $relation;

    /**
     * Apply a query scope.
     *
     * @param $id
     * @param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($id, $relation = 'financeiro_categorias.centro_id')
    {
        $this->id = $id;
        $this->relation = $relation;
    }


    public function apply($query)
    {
        return $query->where($this->relation, $this->id);
    }
}
