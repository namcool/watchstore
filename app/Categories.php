<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'categories';

    public function Products(){
        return $this->hasMany('App\Products','id_categories','id');
    }
}
