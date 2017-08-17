<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiadoCliente extends Model
{
    protected $fillable = [
        'cliente_id',
        'total'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}