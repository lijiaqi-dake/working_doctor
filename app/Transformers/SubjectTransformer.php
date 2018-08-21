<?php

namespace App\Transformers;

use App\Models\Subject;
use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract
{
    public function transform(Subject $subject)
    {
    	return [
            'id' => $subject->id,
            'name' => $subject->name,
    	];
    }	
}