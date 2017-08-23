<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'tipo_id',
    ];

    public function tipo(){
        return $this->belongsTo(PessoaTipo::class, 'tipo_id');
    }

    public function fiado()
    {
        return $this->hasOne(FiadoPessoa::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
