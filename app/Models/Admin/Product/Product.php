<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name',
        'complement',
        'category_id',
    ];

    public function category()
    {

        return $this->belongsTo('App\ProductCategory');
    }

    public function inventory()
    {
        return $this->hasOne('App\ProductInventory');
    }

    public function sales()
    {
        return $this->hasOne('App\SaleProducts');
    }

    public function purchases()
    {
        return $this->hasOne('App\PurchaseProducts');
    }
}
