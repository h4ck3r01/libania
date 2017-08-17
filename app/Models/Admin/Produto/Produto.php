<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $fillable = [
        'nome',
        'complemento',
        'categoria_id',
    ];

    public function categoria()
    {

        return $this->belongsTo(ProdutoCategoria::class);
    }

    public function estoque()
    {
        return $this->hasOne(EstoqueProduto::class);
    }

    public function vendas()
    {
        return $this->hasOne(VendaProduto::class);
    }

    public function compras()
    {
        return $this->hasOne(CompraProduto::class);
    }
}
