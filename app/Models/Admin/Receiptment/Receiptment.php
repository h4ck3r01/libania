<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiptment extends Model
{

    protected $fillable = [
        'sale_id',
        'category_id',
        'client_id',
        'payment',
        'total',
    ];

    public function sale()
    {
        return $this->belongsto('App\Sale');
    }

    public function category()
    {
        return $this->belongsTo('App\FinancialCategory', 'category_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
