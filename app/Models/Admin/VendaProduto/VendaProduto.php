<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{

    protected $fillable = [
        'compra_id',
        'produto_id',
        'preco',
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