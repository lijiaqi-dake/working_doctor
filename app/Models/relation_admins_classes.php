<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class relation_admins_classes extends Model
{
    //模型对应的数据表
    protected $table = 'admins_classes';

    //可更新的字段

    protected $fillable = ['class','grade','admin_id'];


    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }
}
