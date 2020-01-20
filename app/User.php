<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isAdmin','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function findForPassport($identifier) {
        return User::orWhere('email', $identifier)->first();
    }
    public function userBid(){
        return $this->hasMany("App\model\userBid");
    }
    public function user_detail(){
    return $this->hasOne("App\model\user_detail");
    }
}
