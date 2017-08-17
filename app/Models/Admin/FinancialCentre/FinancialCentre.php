<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialCentre extends Model
{

    protected $fillable = [
        'name',
    ];

    public function category(){
        return $this->hasOne('App\FinancialCategory');
    }
}