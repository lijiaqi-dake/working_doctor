<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nice_name', 'sex', 'phone', 'pic', 'school', 'grade', 'class', 'weixin_openid', 'name', 'code', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
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
     * 学生与科目的多对多关系
     */
    public function subjects()
    {
        return $this->belongsToMany(Car::class);
    }

    /**
     * 老师与年级，班级，科目一对多关系
     */
    public function relation_teacher()
    {
        return $this->hasMany(relation_teacher::class);
    }
    /**
     * 批改与学生一对一关系
     */
    public function correct()
    {
        return $this->belongsTo(Correct::class);
    }
    
    /**
     * 学生与批改作业一对多
     */
    public function correct_homework()
    {
        return $this->hasMany(correct_homework::class);
    }

}
