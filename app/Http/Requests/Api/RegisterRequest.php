<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //post提交主要用于第一次注册时填写个人信息
        switch($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string',
                    'code' => 'required|string',
                    'phone' => 'required|string',
                    'grade' => 'required|string',
                   'class' => 'required|string',
                ];
                break;
            //patch提交方法用于修改个人信息
            case 'PATCH':
                $userId = \Auth::guard('api')->id();
                return [
                    'name' => 'required|string',
                    'code' => 'required|string',
                    'phone' => 'required|string',
                    'grade' => 'string',
                    'class' => 'string',
                ];
                break;
         }
    }
}
