<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class userBid extends Model
{
    public function user(){
        return $this->hasMany('App\User');
    }
}
