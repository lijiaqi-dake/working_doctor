<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Homework;
use App\Models\Question;
use App\Models\correct_homework;
use App\Transformers\HomeworkTransformer;
//暂时有问题没解决，多表关联的取值问题
class HomeworkController extends Controller
{
    public function index($user_id)
    {
        // $query = $homework->query();//所有的作业

        // $user = $this->user();//获取当前用户

        // if($userGrade = $user->grade && $userClass = $user->class){//如果用户的学校年纪班级不为空

            // $work = $query->where([
                // 'grade' => $userGrade,
                // 'class' => $userClass,
            // ])->get();
        // }
        // else{
        //     $work = null;
        // }
        // // $work = $query->paginate(20);
        // // return $this->response->item($work,new HomeworkTransformer());//返回作业的信息
        // return Question::find(1)->homework;

        $user = User::find($user_id);
        $created = correct_homework::where([
            'user_id' => $user_id,
        ])->get()->first()->created_at->toDatestring();
        $array['update']= $created;
        $array['name'] = $user->name;
        $array['code'] = $user->code;
        $array['sex'] = $user->sex;

        return $array;

    }

    public function show(Homework $homework,request $request)
    {
        $user=User::find($request->user_id);
        $time=Carbon::today()->toDateString();
        if($user!=NULL){
            $homework = Homework::where([     //显示今日作业
                'subject_id' => 2,
                'grade' => $user->grade,
                'class' => $user->class,
            ])->get();
            if(!$homework->isEmpty()){
                $i=0;
                foreach($homework as $home_work){
                     if($home_work->created_at->toDateString()==$time){
                        $home_work['question'] = Question::find($home_work->question_id);
                        $Homework[$i++]=$home_work;
                    }           
                }
                return $Homework;  
            }            
        }
        return NULL;
    }
    
    public function make_sure(request $request)
    {
        $user=User::find($request->user_id);
        $time=Carbon::today()->toDateString();
        if($user!=NULL){
            $C_homework = correct_homework::where([     //显示今日作业
                'subject_id' => 2,
                'user_id' => $user->id,
            ])->get();
            if(!$C_homework->isEmpty()){
                foreach($C_homework as $C_Homework){
                    if($C_Homework->created_at->toDateString()==$time){
                        $C_Homework->flag=1;
                        $C_Homework->save();
                    }  
                }
                return $C_homework;
            }   
        }
        return NULL;
    }
}
