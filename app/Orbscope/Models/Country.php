<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";

    // Relation With Cities Table
    public function city(){
        return $this->hasMany('App\Orbscope\Models\City','country_id','id');
    }


}
