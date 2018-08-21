<?php

namespace App\Transformers;

use App\Models\correct_homework;
use League\Fractal\TransformerAbstract;

class correct_homeworkTransformer extends TransformerAbstract
{
    public function transform(correct_homework $correct_homework)
    {
    	return [
            'id' => $correct_homework->id,
            'user_id' => $correct_homework->user_id,
            'subject_id' => $correct_homework->subject_id,
            'flag' => $correct_homework->flag,
            'img_url' => $correct_homework->img_url,
    	];
    }	
}