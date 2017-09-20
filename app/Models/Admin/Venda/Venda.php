<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    protected $fillable = [
        'fiado',
        'pessoa_id',
        'forma_id',
        'desconto',
        'total',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function produtos()
    {
        return $this->hasMany(VendaProduto::class);
    }

    public function forma()
    {
        return $this->belongsTo(VendaForma::class, 'forma_id');
    }
}