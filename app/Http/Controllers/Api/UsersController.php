<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\relation_teacher;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Transformers\UserTransformer;

class UsersController extends Controller
{
    public function me(User $user)
    {
        $user=$this->user();
        return $this->response->item($user, new UserTransformer());
    }

    public function destory()//解除微信的绑定
    {
        $user=$this->user();
        $user->weixin_openid=null;
        // return $this->response->item($user, new UserTransformer());//测试用的
    }

    public function update(UserRequest $request)
    {
        $user=$this->user();
        $user->update($request->all());//通过response验证过后的所有提交信息来更新users库里面的信息
    	return $this->response->item($user,new UserTransformer());//返回用户的信息
    }

    //获取与用户所有相关的用户
    public function TeacherPhone()
    {
        $user=$this->user();
        $grade=$user->grade;
        $class=$user->class;
        $teachersId=relation_teacher::where([
            'grade' => $grade,
            'class' => $class
        ])->get();
        $i=0;
        foreach($teachersId as $teacher)
        {
            $name = User::find($teacher->teacher_id)->name;
            $phone = User::find($teacher->teacher_id)->phone;
            $phones[$i++] = [$name,$phone];
        }
        return $phones;
    }
}