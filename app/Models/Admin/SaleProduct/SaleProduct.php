<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{

    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'amount',
        'total',
    ];

    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}