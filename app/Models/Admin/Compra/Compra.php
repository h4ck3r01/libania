<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{

    protected $fillable = [
        'fornecedor_id',
        'total',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function produtos()
    {
        return $this->hasMany(CompraProduto::class);
    }
}