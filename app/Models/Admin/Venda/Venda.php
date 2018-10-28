<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    protected $fillable = [
        'pessoa_id',
        'forma_id',
        'desconto',
        'total',
        'data',
        'forma_id_opcional',
    ];

    protected $dates = [
        'data',
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

    public function forma_opcional()
    {
        return $this->belongsTo(VendaForma::class, 'forma_id_opcional', 'id');
    }
}