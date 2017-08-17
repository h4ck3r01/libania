<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementProduct extends Model
{

    protected $fillable = [
        'movement_id',
        'product_id',
        'amount',
        'flow',
    ];

    public function movement(){
        return $this->belongsTo('App\Movement');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }
}