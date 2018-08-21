<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'reports';

    // 可更新字段
    protected $fillable = ['user_id', 'subject_id', 'type', 'title', 
    'keyword','rate', 'evaluate', 'day_num', 'question_num', 'advantage',
    'disadvantage', 'summary_a', 'summary_b', 'summary_c', 'motto'];
    
    // 隐藏字段
    // protected $hidden = [];
}
