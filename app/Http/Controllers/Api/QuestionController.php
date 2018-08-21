<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Homework;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\Api\QuestionRequest;
use App\Transformers\QuestionTransformer;
use App\Transformers\HomeworkTransformer;

class QuestionController extends Controller
{
    //题目查询
    public function search_question(Question $question,QuestionRequest $request)  
    {
        $question = Question::where([
            'subject_id' => $request->subject_id,
            'from' => $request->from,
            'book' => $request->book,
            'page' => $request->page,
            'q_num' => $request->q_num,
        ])->get()->first();

        return $this->response->item($question,new QuestionTransformer());

    }


    //作业题目确定
    public function search_add_question(Question $question,QuestionRequest $request)
    {
        $BZ=true;   //作业题目是否已经录过的标志
        $time=Carbon::today()->toDateString();
        $question = Question::where([
            'subject_id' => $request->subject_id,
            'from' => $request->from,
            'book' => $request->book,
            'page' => $request->page,
            'q_num' => $request->q_num,
        ])->get()->first();
        $homework = Homework::where([    //查找作业库中有没有该题，避免重复录作业
            'subject_id' => $request->subject_id,
            'question_id' => $question->id,
            'grade' => $request->grade,
            'class' => $request->class,
        ])->get();
        foreach($homework as $home_work){
            if($home_work->created_at->toDateString()==$time){
                $BZ=false;
           }           
       }

        if($question!=NULL && $BZ){   //将作业加入今日作业库
            Homework::create([
                'grade' => $request->grade,
                'class' => $request->class,
                'question_id' => $question->id,
                'subject_id' => $question->subject_id,
            ]);
        }

        $homework = Homework::where([     //始终显示今日作业
             'subject_id' => $request->subject_id,
             'grade' => $request->grade,
             'class' => $request->class,
        ])->get();
        $i=0;
        foreach($homework as $home_work){
            if($home_work->created_at->toDateString()==$time){
                $home_work['subject'] = Subject::find($home_work->subject_id);
                $home_work['question'] = Question::find($home_work->question_id);
                $Homework[$i++]=$home_work;
            }
        }
        return $Homework;   
        

    }


    public function add_question(Request $request)
    {
        $this->validate($request, [ 
            'subject_id' => 'required|string',
            'content' => 'required|string',
            'grade' => 'required|string',
            'from' => 'required|string',
            'book' => 'required|string',
            'page' => 'required|string',
            'q_num' => 'required|string',
            'tag_type' => 'required|string',
            'tag_point' => 'required|string'
        ]);

         Question::create([
            'subject_id' => $request->subject_id,
            'content' => $request->content,
            'grade' => $request->grade,
            'from' => $request->from,
            'book' => $request->book,
            'page' => $request->page,
            'q_num' => $request->q_num,
            'tag_type' => $request->tag_type,
            'tag_point' => $request->tag_point
        ]);
    }

}
