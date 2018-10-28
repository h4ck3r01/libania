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

    protected $dates = [
        'data_ultimo'
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
}