<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimentoProduto extends Model
{

    protected $fillable = [
        'movimento_id',
        'produto_id',
        'quantidade',
        'fluxo',
    ];

    public function movimento(){
        return $this->belongsTo(Movimento::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}