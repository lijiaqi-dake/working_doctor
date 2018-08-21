<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'notices';

    // 可更新字段
    protected $fillable = ['notice_content', 'grade', 'class', 'notice_type', 'school', 'subject_id'];
    
    // 隐藏字段
    // protected $hidden = [];

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
}
