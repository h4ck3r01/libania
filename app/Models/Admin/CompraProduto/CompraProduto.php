<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{

    protected $fillable = [
        'compra_id',
        'produto_id',
        'preco',
        'quantidade',
        'total',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function setPrecoAttribute($preco)
    {
        $this->attributes['preco'] = formatMoney($preco);
    }

    public function setTotalAttribute($total)
    {
        $this->attributes['total'] = formatMoney($total);
    }
}