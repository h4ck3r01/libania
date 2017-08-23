<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaTipo extends Model
{

    protected $fillable = [
        'nome',
    ];

    public function pessoa()
    {
        return $this->hasMany(Pessoa::class);
    }
}
