<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class RelacaoVendasScope implements DataTableScopeContract
{

    protected $data_inicial, $data_final, $relation, $categoria;

    /**
     * Apply a query scope.
     *
     * @param $data_inicial
     * @param $data_final
     * @param $categoria
     * @param $cliente
     * @param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($data_inicial, $data_final, $categoria, $relation = 'vendas.data')
    {
        $this->relation = $relation;
        $this->data_inicial = $data_inicial;
        $this->data_final = $data_final;
        $this->categoria = $categoria;
    }

    public function apply($query)
    {
        $query->whereBetween($this->relation, array($this->data_inicial, $this->data_final));

        if ($this->categoria != '')
            $query->whereCategoriaId($this->categoria);

        return $query;
    }
}
