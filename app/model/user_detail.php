<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user_detail extends Model
{
    protected $fillable = [
        'user_id','company_name','industry','country','phone'
    ];
}
