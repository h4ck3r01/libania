<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{

    protected $fillable = [
        'vencimento',
        'pessoa_id',
        'obs',
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

    public function setTotalAttribute($total)
    {
        $this->attributes['total'] = formatMoney($total);
    }
}