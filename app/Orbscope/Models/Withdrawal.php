<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table='withdrawals';

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}
