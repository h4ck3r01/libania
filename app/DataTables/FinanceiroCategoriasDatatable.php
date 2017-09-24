<?php
/**
 * Created by PhpStorm.
 * User: h4ck3r01
 * Date: 19/08/2017
 * Time: 21:45
 */

namespace App;

use Yajra\Datatables\Services\DataTable;

class FinanceiroCategoriasDatatable extends Datatable
{
    
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    public function query()
    {
        $categorias = FinanceiroCategoria::select('financeiro_categorias.*');

        return $this->applyScopes($categorias);
    }

}