<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = [
        'category_id','name','body','budget','skills_required','end_date','currency'
    ];
    public function project_detail(){
        return $this->hasOne('App\model\project_detail');
    }
}
