<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = "products";

    public function Categories(){
        return $this->belongsTo('App\Categories','id_category','id');
    }

    public function Bill_detail(){
        return $this->hasMany('App\Bill_detail','id_product','id');
    }
}
