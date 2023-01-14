<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table='reviews';

    public function owner(){
        return $this->hasOne('App\User', 'id','owner_id');

    }

    public function user(){
        return $this->hasOne('App\User', 'id','user_id');
    }

    public function order(){
        return $this->hasOne('App\Orbscope\Models\Order','id','order_id');
    }
}
