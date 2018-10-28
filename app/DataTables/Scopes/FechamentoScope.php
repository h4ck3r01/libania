<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class FechamentoScope implements DataTableScopeContract
{

    protected $data, $forma, $relation_1, $relation_2;

    /**
     * Apply a query scope.
     *
     * @param $data
     * @param string $forma
     * @param $relation_1
     * @param string $relation_2
     * @internal param string $relation
     * @internal param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($data, $relation_1, $forma = '', $relation_2 = '')
    {
        $this->data = $data;
        $this->forma = $forma;
        $this->relation_1 = $relation_1;
        $this->relation_2 = $relation_2;
    }

    public function apply($query)
    {
        $query->where($this->relation_1, $this->data);

        if($this->relation_2 != '')
            $query->whereIn($this->relation_2, $this->forma);

        return $query;
    }
}
