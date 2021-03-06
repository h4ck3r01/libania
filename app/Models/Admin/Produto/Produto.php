<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{

    protected $fillable = [
        'nome',
        'categoria_id',
        'preco',
        'compra',
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
        $nome = capitalizeName($nome);

        return $this->attributes['nome'] = $nome;
    }

    protected function setPrecoAttribute($preco)
    {
        return $this->attributes['preco'] = formatMoney($preco);
    }

    protected function setCompraAttribute($compra)
    {
        return $this->attributes['compra'] = formatMoney($compra);
    }

}