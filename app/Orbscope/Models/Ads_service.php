<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Ads_service extends Model
{
    protected $table='ads_services';

    public function service_name(){
        return $this->hasOne('App\Orbscope\Models\Service','id','service_id');
    }

}
