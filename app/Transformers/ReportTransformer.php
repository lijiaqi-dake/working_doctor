<?php

namespace App\Transformers;

use App\Models\Subject;
use League\Fractal\TransformerAbstract;

class ReportTransformer extends TransformerAbstract
{
    public function transform(Report $report)
    {
    	return [
            'id' => $report->id,
            'user_id' => $report->user_id,
            'subject_id' => $report->subject_id,
            'type' => $report->type,
            'title' => $report->title,
            'rate' => $report->rate,
            'evaluate' => $report->evaluate,
            'keyword' => $report->keyword,
            'day_num' => $report->day_num,
            'question_num' => $report->question_num,
            'advantage' => $report->advantage,
            'disadvantage' => $report->disadvantage,
            'summary_a' => $report->summary_a,
            'summary_b' => $report->summary_b,
            'summary_c' => $report->summary_c,
            'motto' => $report->motto,
    	];
    }

    public function includeSubject(Report $report)
    {
        return $this->item($report->subject,new SubjectTransformer());
    }
}