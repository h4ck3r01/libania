<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{

    protected $fillable = [
        'venda_id',
        'categoria_id',
        'forma_id',
        'pessoa_id',
        'data',
        'total',
    ];

    protected $dates = [
        'data'
    ];

    public function venda()
    {
        return $this->belongsto(Venda::class);
    }

    public function categoria()
    {
        return $this->belongsTo(FinanceiroCategoria::class, 'categoria_id');
    }

    public function forma()
    {
        return $this->belongsTo(VendaForma::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    protected function setTotalAttribute($total)
    {
        return $this->attributes['total'] = formatMoney($total);
    }
}