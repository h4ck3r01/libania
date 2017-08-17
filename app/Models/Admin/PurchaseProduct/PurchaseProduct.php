<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{

    protected $fillable = [
        'purchase_id',
        'product_id',
        'price',
        'amount',
        'total',
    ];

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}