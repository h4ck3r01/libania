<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstoqueProduto extends Model
{

    protected $fillable = [
        'produto_id',
        'movimento_entrada',
        'movimento_saida',
        'venda',
        'total',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
