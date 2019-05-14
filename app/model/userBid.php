<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class userBid extends Model
{
    public function user(){
        return $this->hasMany('App\User');
    }
    public function project(){
        return $this->belongsTo('App\model\project');
    }
    /* public function company(){
        return $this->belongsTo('App\User','id');
    } */
}
