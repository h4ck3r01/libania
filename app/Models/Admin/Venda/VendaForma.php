<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaForma extends Model
{

    protected $fillable = [
        'nome',
    ];

    public function venda()
    {
        return $this->hasMany(Venda::class);
    }
}
