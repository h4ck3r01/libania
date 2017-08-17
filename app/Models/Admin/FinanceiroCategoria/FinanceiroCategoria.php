<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceiroCategoria extends Model
{

    protected $fillable = [
        'centro_id',
        'nome',
        'fluxo',
    ];

    public function centro()
    {
        return $this->belongsTo(FinanceiroCentro::class);
    }
}
