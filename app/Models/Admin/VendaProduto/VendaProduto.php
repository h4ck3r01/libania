<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{

    protected $fillable = [
        'venda_id',
        'compra_id',
        'produto_id',
        'quantidade',
        'total',
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}