<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Transformers\UserTransformer;


class RegistersController extends Controller
{
    public function update(RegisterRequest $request)
    {
    	$user = $this->user();//获取当前用户
    	$attributes = $request->only(['grade','class','code','phone']);//only是只提取数组里面规定的几种属性
    	$user->update($attributes);//通过response验证过后的再提取部分提交信息来更新users库里面的信息

    	return $this->response->item($user,new UserTransformer());//返回用户的信息

    }

    public function store(RegisterRequest $request)
    {
    	 $user = $this->user();//获取当前用户

    	$user->update($request->all());//通过response验证过后的所有提交信息来更新users库里面的信息

    	return $this->response->item($user,new UserTransformer());//返回用户的信息
    }
}
