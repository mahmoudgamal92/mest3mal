<?php

namespace App;

use App\Orbscope\Models\Message;
use App\Orbscope\Models\OnlinePayment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Authorizable;
use Cache;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'phone', 'country', 'years', 'type', 'address', 'cv_file'
    ];

    public function agent_types()
    {
        return $this->hasOne('App\Orbscope\Models\AgentType', 'id', 'agent_type');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function balance()
    {
        return $this->hasMany(OnlinePayment::class);
    }


    // Relation With Log Table
    public function log()
    {
        return $this->hasMany('App\Orbscope\Models\Log', 'user_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany('App\Orbscope\Models\User_Video', 'user_id', 'id');
    }

    public function chanels()
    {
        return $this->hasMany('App\Orbscope\Models\Chanel', 'user_id', 'id');
    }




    public function country()
    {
        return $this->hasOne('App\Orbscope\Models\Country', 'id', 'country_id');
    }

    public function portfolio()
    {
        return $this->hasMany('App\Orbscope\Models\User_Portifolio', 'user_id', 'id');
    }





    public function orders()
    {
        return $this->hasMany('App\Orbscope\Models\Order', 'user_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Orbscope\Models\Project', 'user_id');
    }

    public function employ_project()
    {
        return $this->hasMany('App\Orbscope\Models\Project', 'freelancer');
    }

    public function exper()
    {
        return $this->hasMany('App\Orbscope\Models\User_Experince', 'user_id');
    }

    public function edu()
    {
        return $this->hasMany('App\Orbscope\Models\User_Education', 'user_id');
    }

    public function qual()
    {
        return $this->hasMany('App\Orbscope\Models\User_Qualification', 'user_id');
    }

    public function skills()
    {
        return $this->belongsToMany(
            'App\Orbscope\Models\Category',
            'freelancer__skills',
            'user_id',
            'cat_id'
        );
    }

    public function pages()
    {
        return $this->belongsToMany(
            'App\Orbscope\Models\Page',
            'user_pages',
            'user_id',
            'page_id'
        );
    }

    public function Rates()
    {
        return $this->hasMany('App\Orbscope\Models\Rate', 'user_id');
    }

    public function review()
    {
        return $this->hasMany('App\Orbscope\Models\Review', 'user_id');
    }

    public function pending_order()
    {
        return $this->belongsToMany('App\Orbscope\Models\Order', 'user__orders', 'user_id', 'order_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(
            'App\Orbscope\Models\Service',
            'wishlists',
            'user_id',
            'service_id'
        );
    }
}
