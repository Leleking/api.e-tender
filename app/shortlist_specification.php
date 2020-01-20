<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shortlist_specification extends Model
{
    public function project(){
        return $this->belongsTo("App\model\project");
    }
}
