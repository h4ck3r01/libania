<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
      'name',
    ];

    public function products(){
        return $this->hasOne('App\Product', 'category_id');
    }
}
