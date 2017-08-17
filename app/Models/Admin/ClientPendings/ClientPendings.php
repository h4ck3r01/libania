<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPendings extends Model
{
    protected $fillable = [
        'client_id',
        'total'
    ];

    public function client(){
        return $this->belongsTo('App\Client');
    }
}