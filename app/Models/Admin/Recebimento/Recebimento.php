<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{

    protected $fillable = [
        'venda_id',
        'categoria_id',
        'cliente_id',
        'pagamento',
        'total',
    ];

    public function venda()
    {
        return $this->belongsto(Venda::class);
    }

    public function categoria()
    {
        return $this->belongsTo(FinanceiroCategoria::class, 'categoria_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Cliente');
    }
}
