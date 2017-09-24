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

    public function getFluxoAttribute($fluxo)
    {
        ($fluxo == '1') ? $fluxo = __('views.admin.cc.fluxo_1') : $fluxo = __('views.admin.cc.fluxo_2');

        return $fluxo;
    }

    protected function setNomeAttribute($nome)
    {
        return $this->attributes['nome'] = ucwords(strtolower($nome));
    }
}
