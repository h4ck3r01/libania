<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiadoPessoa extends Model
{
    protected $fillable = [
        'pessoa_id',
        'total'
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
}