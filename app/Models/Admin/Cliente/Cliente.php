<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'nome',
        'telefone',
        'email',
    ];

    public function fiado()
    {
        return $this->hasOne(FiadoCliente::class);
    }

    public function vendas()
    {
        return $this->hasMany('App\Venda');
    }
}
