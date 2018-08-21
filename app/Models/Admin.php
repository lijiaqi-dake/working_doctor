<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class admin extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $table="admins";
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account','admin_phone','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



        // Rest omitted for brevity

    public function getJWTIdentifier()
    {
        return $this->getKey();//获取当前用户的id
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * 批改与志愿者一对一关系
     */
    public function correct()
    {
        return $this->hasOne(Correct::class);
    }

    public function relation_admins_classes()
    {
        return $this->hasOne(relation_admins_classes::class);
    }


}
