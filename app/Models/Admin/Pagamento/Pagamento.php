<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Compilers\Concerns\CompilesRawPhp;

class Pagamento extends Model
{

    protected $fillable = [
        'compra_id',
        'categoria_id',
        'pessoa_id',
        'vencimento',
        'total'
    ];

    public function compra()
    {
        return $this->belongsto(Compra::class);
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