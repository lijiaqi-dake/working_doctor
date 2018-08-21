<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correct extends Model
{
    // 配置数据表，这里取默认
    protected $table = 'correct';

    // 可更新字段
    protected $fillable = ['user_id', 'subject_id', 'question_id', 'admin_id', 'judge', 'img_url', 'corrected'];
    
    // 隐藏字段
    // protected $hidden = [];


    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }


    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }


    public function questions()
    {
        return $this->belongs(Question::class);
    }
}
