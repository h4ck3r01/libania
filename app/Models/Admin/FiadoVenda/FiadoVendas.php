<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiadoVendas extends Model
{

    protected $fillable = [
        'pessoa_id',
        'venda_id',
        'data',
        'total',
    ];

    protected $dates = [
        'data'
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }

    public function venda(){
        return $this->belongsTo(Venda::class);
    }
}