<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class relation_teacher extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'relation_teacher';

    // 可更新字段
    protected $fillable = ['user_id', 'grade', 'class', 'subject_id'];
    
    // 隐藏字段
    // protected $hidden = [];

    /**
     * 老师与年级，班级，科目一对多关系
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
