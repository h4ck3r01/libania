<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{

    protected $fillable = [
        'product_id',
        'movement_in',
        'movement_out',
        'sale',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
