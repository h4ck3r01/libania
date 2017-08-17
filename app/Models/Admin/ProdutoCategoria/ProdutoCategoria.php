<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoCategoria extends Model
{
    protected $fillable = [
      'nome',
    ];

    public function produtos(){
        return $this->hasOne(Produto::class, 'categoria_id');
    }
}
