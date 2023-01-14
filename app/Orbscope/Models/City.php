<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    // Relation With Countries Table
    public function city_country(){
        return $this->hasOne('App\Orbscope\Models\Country','id','country_id');
    }




}
