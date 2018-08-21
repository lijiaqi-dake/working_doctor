<?php

namespace App\Transformers;

use App\Models\Correct;
use League\Fractal\TransformerAbstract;

class CorrectTransformer extends TransformerAbstract
{
    public function transform(Correct $correct)
    {
    	return [
            'id' => $correct->id,
            'user_id' => $correct->user_id,
            'subject_id' => $correct->subject_id,
            'question_id' => $correct->question_id,
            'judge' => $correct->judge,
            'admin_id' => $correct->admin_id,
            'corrected' => $correct->corrected,
            'img_url' => $correct->img_url,
    	];
    }	
}