<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class correct_homework extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'correct_homework';

    // 可更新字段
    protected $fillable = ['user_id', 'subject_id', 'flag', 'img_url','class','grade'];
    
    // 隐藏字段
    // protected $hidden = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * 科目与批改作业一对多
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
}
