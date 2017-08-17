<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{

    protected $fillable = [
        'centre_id',
        'name',
        'flow',
    ];

    public function centre()
    {
        return $this->belongsTo('App\FinancialCentre');
    }
}
