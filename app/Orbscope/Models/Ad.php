<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table='ads';

    public function state(){
        return $this->hasOne('App\Orbscope\Models\City','id','city_id');
    }
    public function city(){
        return $this->hasOne('App\Orbscope\Models\Country','id','state_id');
    }
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function depart(){
        return $this->hasOne('App\Orbscope\Models\Department','id','depart_id');
    }


    public function category(){
        return $this->hasOne('App\Orbscope\Models\Category','id','cat_id');
    }
    
    public function subCategory(){
        return $this->hasOne('App\Orbscope\Models\SubCategory','id','sub_cat_id');
    }

    public function services(){

         return $this->hasMany('App\Orbscope\Models\Ads_service','ad_id','id');
    }
    public function orders(){

        return $this->hasMany('App\Orbscope\Models\Order','ad_id','id');
    }


}
