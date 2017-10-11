<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class PagamentosScope implements DataTableScopeContract
{

    protected $data_inicial, $data_final, $relation, $categoria, $fornecedor;

    /**
     * Apply a query scope.
     *
     * @param $data_inicial
     * @param $data_final
     * @param $categoria
     * @param $fornecedor
     * @param string $relation
     * @internal param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     */

    public function __construct($data_inicial, $data_final, $categoria, $fornecedor, $relation = 'pagamentos.vencimento')
    {
        $this->relation = $relation;
        $this->data_inicial = $data_inicial;
        $this->data_final = $data_final;
        $this->categoria = $categoria;
        $this->fornecedor = $fornecedor;
    }


    public function apply($query)
    {
        $query->whereBetween($this->relation, array($this->data_inicial, $this->data_final));

        if ($this->categoria != '')
            $query->whereCategoriaId($this->categoria);

        if ($this->fornecedor != '')
            $query->wherePessoaId($this->fornecedor);

        return $query;
    }
}
