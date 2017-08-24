<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $fillable = [
        'nome',
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

    protected function setNomeAttribute($nome)
    {
        return $this->attributes['nome'] = ucwords(strtolower($nome));
    }
}
