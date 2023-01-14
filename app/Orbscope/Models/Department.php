<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='departments';


    public function category()
    {
        return $this->hasMany('App\Orbscope\Models\Category', 'depart_id');
    }


}


