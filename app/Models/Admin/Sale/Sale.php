<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $fillable = [
        'pending',
        'client_id',
        'total',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function products()
    {
        return $this->hasMany('App\SaleProducts');
    }
}