<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';


    public function depart(){
        return $this->hasOne('App\Orbscope\Models\Department','id','depart_id');
    }

    public function subCats()
    {
        return $this->hasMany('App\Orbscope\Models\SubCategory', 'cat_id');
    }

    public function products()
    {
        return $this->hasMany('App\Orbscope\Models\Product', 'cat_id');
    }

    public function projects(){
        return $this->belongsToMany('App\Orbscope\Models\Project', 'project__skills',
            'skill_id', 'project_id');
    }

    public function services(){
        return $this->belongsToMany('App\Orbscope\Models\Service', 'service__skills',
            'cat_id', 'service_id');
    }

}
