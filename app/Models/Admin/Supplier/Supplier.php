<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'email',
        'identifier',
        'cep',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',

    ];

    public function purchases()
    {
        return $this->hasMany('App\Supplier');
    }
}
