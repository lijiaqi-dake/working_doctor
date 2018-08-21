<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'subjects';

    // 可更新字段
    protected $fillable = ['name'];
    
    // 隐藏字段
    // protected $hidden = [];

    /**
     * 学生与科目的多对多关系
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * 科目与题目的一对多关系
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * 批改与科目一对一关系
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

    /**
     * 科目与题目的一对多关系
     */
    public function notices()
    {
        return $this->hasMany(Notice::class);
    }
    
    /**
     * 科目与批改作业一对多
     */    
    public function correct_homework()
    {
        return $this->hasMany(correct_homework::class);
    }
}
