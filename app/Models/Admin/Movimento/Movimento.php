<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    protected $fillable = [
      'obs'
    ];

    public function productos()
    {
        return $this->hasMany(MovimentoProduto::class);
    }
}
