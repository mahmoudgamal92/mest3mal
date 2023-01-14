<?php

namespace App\Orbscope\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';

    protected $guarded=[];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function man(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function reciver(){
        return $this->hasOne('App\User','id','reciver_id');
    }
}
