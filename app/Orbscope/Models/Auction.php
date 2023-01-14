<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    protected $table='auctions';

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function state(){
        return $this->hasOne('App\Orbscope\Models\City','id','city_id');
    }
    public function city(){
        return $this->hasOne('App\Orbscope\Models\Country','id','state_id');
    }

    public function offers(){
        return $this->hasMany('App\Orbscope\Models\Offer','auction_id','id');
    }
}
