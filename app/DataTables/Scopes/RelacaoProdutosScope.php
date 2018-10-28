<?php

namespace App\DataTables\Scopes;

use Yajra\Datatables\Contracts\DataTableScopeContract;

class RelacaoProdutosScope implements DataTableScopeContract
{

    protected $data_inicial, $data_final, $categoria, $relation_1, $relation_2;

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

    public function __construct($data_inicial, $data_final, $categoria, $relation_1 = 'venda_produtos.data', $relation_2 = 'compra_produtos.vencimento')
    {
        $this->relation_1 = $relation_1;
        $this->relation_2 = $relation_2;
        $this->data_inicial = $data_inicial;
        $this->data_final = $data_final;
        $this->categoria = $categoria;
    }


    public function apply($query)
    {
        /*$query->whereBetween($this->relation_1, array($this->data_inicial, $this->data_final));

        $query->whereBetween($this->relation_2, array($this->data_inicial, $this->data_final));

        if ($this->categoria != '')
            $query->whereCategoriaId($this->categoria)*/

        return $query;
    }
}
