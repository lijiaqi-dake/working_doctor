<?php

namespace App\Transformers;

use App\Models\Homework;
use League\Fractal\TransformerAbstract;

class HomeworkTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['question','subject'];


    public function transform(Homework $homework)
    {
    	return [
            'id' => $homework->id,
            'grade' => $homework->grade,
            'class' => $homework->class,
            'question_id' => $homework->question_id,
            'subject_id' => $homework->subject_id,
            'created_at' => $homework->created_at->toDateTimeString(),
            'updated_at' => $homework->updated_at->toDateTimeString(),
    	];
    }	

    public function includeQuestion(Homework $homework)
    {
        return $this->item($homework->question,new QuestionTransformer());
    }

    public function includeSubject(Homework $homework)
    {
        return $this->item($homework->subject,new SubjectTransformer());
    }
}