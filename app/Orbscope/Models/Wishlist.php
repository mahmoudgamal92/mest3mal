<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';


    public function ad()
    {
        return $this->hasOne(Ad::class, 'id', 'ad_id');
    }
}
