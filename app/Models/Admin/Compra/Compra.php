<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{

    protected $fillable = [
        'vencimento',
        'pessoa_id',
        'obs',
        'desconto',
        'juros',
        'total',
    ];

    protected $dates = [
        'vencimento',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function produtos()
    {
        return $this->hasMany(CompraProduto::class);
    }

    public function setDescontoAttribute($desconto)
    {
        $this->attributes['desconto'] = formatMoney($desconto);
    }

    public function setJurosAttribute($juros)
    {
        $this->attributes['juros'] = formatMoney($juros);
    }

    public function setTotalAttribute($total)
    {
        $this->attributes['total'] = formatMoney($total);
    }
}