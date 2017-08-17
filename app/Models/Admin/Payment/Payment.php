<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'purchase_id',
        'category_id',
        'supplier_id',
        'payment',
        'total'
    ];

    public function purchase()
    {
        return $this->belongsto('App\Purchase');
    }

    public function category()
    {
        return $this->belongsTo('App\FinancialCategory', 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}