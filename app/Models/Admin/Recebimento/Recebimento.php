<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{

    protected $fillable = [
        'venda_id',
        'categoria_id',
        'pessoa_id',
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

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
