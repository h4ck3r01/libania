<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'identificador',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',

    ];

    public function compras()
    {
        return $this->hasMany(Compras::class);
    }
}
