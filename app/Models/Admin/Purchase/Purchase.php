<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $fillable = [
        'supplier_id',
        'total',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function products()
    {
        return $this->hasMany('App\PurchaseProduct');
    }
}