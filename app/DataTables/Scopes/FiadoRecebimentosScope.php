<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class FiadoRecebimentosScope implements DataTableScopeContract
{

    protected $id, $categoria_id, $relation_1, $relation_2;

    /**
     * Apply a query scope.
     *
     * @param $id
     * @param string $relation_1
     * @param string $relation_2
     * @internal param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($id, $relation_1 = 'recebimentos.pessoa_id', $relation_2 = 'recebimentos.categoria_id')
    {
        $this->id = $id;
        $this->categoria_id = 3;
        $this->relation_1 = $relation_1;
        $this->relation_2 = $relation_2;
    }

    public function apply($query)
    {
        return $query->where($this->relation_1, $this->id)->where($this->relation_2, $this->categoria_id);
    }
}
