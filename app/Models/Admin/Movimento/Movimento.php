<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    protected $fillable = [
        'data',
        'fluxo',
        'obs',
    ];

    protected $dates = [
        'data',
    ];

    public function produtos()
    {
        return $this->hasMany(MovimentoProduto::class);
    }

    protected function getFluxoAttribute($fluxo)
    {

        ($fluxo == '1') ? $fluxo = __('views.admin.movimento.fluxo_1') : $fluxo = __('views.admin.movimento.fluxo_2');

        return $fluxo;
    }
}
