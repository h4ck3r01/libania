<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiadoPessoa extends Model
{
    protected $fillable = [
        'pessoa_id',
        'total',
        'data_ultimo',
        'total_ultimo'
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }

    protected function setTotalAttribute($total)
    {
        return $this->attributes['total'] = formatMoney($total);
    }

    protected function setTotalUltimoAttribute($total_ultimo)
    {
        return $this->attributes['total_ultimo'] = formatMoney($total_ultimo);
    }
}