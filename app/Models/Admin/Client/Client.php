<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    public function pendings()
    {
        return $this->hasOne('App\ClientPendings');
    }

    public function sales()
    {
        return $this->hasMany('App\Sales');
    }
}
