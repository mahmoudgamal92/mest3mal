<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class AgentType extends Model
{
    protected $table = 'agent_types';


    public function targets() {
    	return $this->hasMany('App\Orbscope\Models\Target', 'agent_type');
    }


    public function lastTarget() {
        return $this->hasMany('App\Orbscope\Models\Target', 'agent_type')->orderBy('id', 'DESC');
    }



    public function agents() {
        return $this->hasMany('App\Orbscope\Models\User', 'agent_type');
    }



}
