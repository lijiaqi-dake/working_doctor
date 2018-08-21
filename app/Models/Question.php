<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class Question extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'questions';

    // 可更新字段
    protected $fillable = ['subject_id', 'content', 'grade', 'from', 'page','book','q_num','tag_type','tag_point'];
    
    // 隐藏字段
    // protected $hidden = [];

    /**
     * 科目与题目的一对多关系
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * 批改与题目一对一关系
     */
    public function correct()
    {
        return $this->hasOne(Correct::class);
    }

     /**
     * 作业与学科一对一
     */
    public function homework()
    {
        return $this->hasOne(Homework::class);
    }

    // Rest omitted for brevity

    public function getJWTIdentifier()
    {
        return $this->getKey();//获取当前用户的id
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
