<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{

    protected $table='onlinepayments';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
