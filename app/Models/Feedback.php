<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table= 'feedback';

    // 可更新字段
    protected $fillable = ['user_id', 'phone', 'feedback_content'];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
