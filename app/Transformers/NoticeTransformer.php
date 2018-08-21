<?php

namespace App\Transformers;

use App\Models\Notice;
use League\Fractal\TransformerAbstract;

class NoticeTransformer extends TransformerAbstract
{
    public function transform(Notice $notice)
    {
    	return [
            'id' => $notice->id,
            'grade' => $notice->grade,
            'class' => $notice->class,
            'notice_content' => $notice->notice_content,
            'notice_type' => $notice->notice_type,
            'school' => $notice->school, 
            'subject_id' => $notice->subject_id,   
    	];
    }	
}