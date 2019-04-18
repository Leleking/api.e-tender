<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function project(){
        return $this->hasMany("App\model\project");
    }
}
