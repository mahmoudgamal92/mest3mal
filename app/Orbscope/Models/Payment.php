<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table='payments';

    public function order(){
        return $this->hasOne('App\Orbscope\Models\Order','id','order_id');
    }


    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
