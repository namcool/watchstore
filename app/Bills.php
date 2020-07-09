<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    //
    protected $table = 'bills';

    public function Bill_detail(){
        return $this->hasMany('App\Bill_detail','id_bill','id');
    }

    public function Customers(){
        return $this->belongsTo('App\Customers','id_customer','id');
    }
}
