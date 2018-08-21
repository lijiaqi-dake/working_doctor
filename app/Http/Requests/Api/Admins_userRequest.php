<?php

namespace App\Http\Requests\Api;

// use Illuminate\Foundation\Http\FormRequest;
use Dingo\Api\Http\FormRequest;

class Admins_userRequest extends FormRequest
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
        return [
            'grade' => 'nullable|string',
            'class' => 'nullable|string',
            'time'  => 'nullable|string',  //参数可以为空
            'type'  => 'nullable|string',  //有无处理判断，=NULL全部 =0未处理 =1已处理
            'code'  => 'nullable|string'
        ];
    }
}
