<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected  $table='offers';

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function auction(){
        return $this->hasOne('App\Orbscope\Models\AD','id','auction_id');
    }
}
