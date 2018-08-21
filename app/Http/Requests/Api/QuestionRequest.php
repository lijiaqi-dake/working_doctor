<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'subject' => 'nullable|int',
            'from' => 'nullable|string',
            'book' => 'nullable|string',
            'page' => 'nullable|int',
            'q_num' => 'nullable|string',
        ];
    }
}
