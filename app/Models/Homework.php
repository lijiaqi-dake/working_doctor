<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'homework';

    // 可更新字段
    protected $fillable = ['subject_id', 'question_id', 'school', 'grade', 'class'];
    
    // 隐藏字段
    // protected $hidden = [];

    /**
     * 作业与学科一对一
     */
    public function subjects()
    {
       return $this->belongsTo(Subject::class);
    }
    /**
     * 作业与题库一对一 
     */
    public function questions()
    {
       return $this->belonsTo(Question::class);
    }
}
