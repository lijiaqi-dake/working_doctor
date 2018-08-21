<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
    	return [
    		'id' => $user->id,
    		'name' => $user->name,
			'nice_name' => $user->nice_name,
			'sex' => $user->sex,
    		'code' => $user->code,
    		'phone' => $user->phone,
			'pic' => $user->pic,
			'school' => $user->school,
    		'grade' => $user->grade,
            'class' => $user->class,
            'type' => $user->type,
            'weixin_openid' => $user->weixin_openid,
            // 状态
            'bound_phone' => $user->phone ? true : false,
    		// 'created_at' => $user->created_at->toDateTimeString(),
            // 'updated_at' => $user->updated_at->toDateTimeString(),
    	];
    }	
}