<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class project_detail extends Model
{
    protected $fillable = [
        'project_id','tender_type_id','region_id','agency','contact','funding'
    ];
    //all project details, belong to a project
    public function project(){
        return $this->belongsTo("App\model\project");
    }
    /* each project can have one and only one tender type
     */
    public function tender_type(){
       return $this->belongsTo('App\model\tender_type');
    }
    public function region(){
       return $this->belongsTo('App\model\region');
    }
}
