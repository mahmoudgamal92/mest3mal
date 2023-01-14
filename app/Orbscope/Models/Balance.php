<?php


namespace App\Orbscope\Models;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table='balances';

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function resource(){
        return $this->hasOne('App\Orbscope\Models\Resource','id','order_id');
    }
}
