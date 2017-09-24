<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceiroCentro extends Model
{

    protected $fillable = [
        'nome',
    ];

    public function categoria(){
        return $this->hasOne(FinanceiroCategoria::class);
    }

    protected function setNomeAttribute($nome)
    {
        return $this->attributes['nome'] = ucwords(strtolower($nome));
    }
}