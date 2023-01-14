<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';


    public function ad(){
        return $this->hasOne('App\Orbscope\Models\Ad','id','ad_id');
    }

    public function review(){
        return $this->hasOne('App\Orbscope\Models\Review','order_id','id');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }

    public function seller()
    {
        return $this->hasOne('App\User', 'id','seller_id');
    }
}
