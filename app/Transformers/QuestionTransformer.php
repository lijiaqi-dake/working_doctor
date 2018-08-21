<?php

namespace App\Transformers;

use App\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    public function transform(Question $question)
    {
    	return [
            'id' => $question->id,
            'content' => $question->content,
            'subject_id' => $question->subject_id,
            'grade' => $question->grade,
            'from' => $question->from,
            'page' => $question->page,
            'book' => $question->book,
            'q_num' => $question->q_num,
            'tag_type' => $question->tag_type,
            'tag_point' => $question->tag_point,
    	];
    }	
}