<?php

namespace App\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\correct_homework;
use App\Models\Admin;
use App\Models\Correct;
use App\Models\Homework;
use App\Models\relation_admins_classes;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\CorrectTransformer;
use App\Http\Requests\Api\Admins_userRequest;

class Admins_userController extends Controller
{
    public function show(User $user,Admins_userRequest $request,correct_homework $c_homework)
    {
        
        switch($request->type) {
            case NULL: //全部 默认

                if($request->time == NULL && $request->code == NULL)   //年级班级同时筛选，时间筛选为空
                {
                 	$c_homework = correct_homework::where([
                    'grade' => $request->grade,
                    'class' => $request->class
                    ])->orderBy('created_at', 'desc')->get();   //倒序输出
                    if(!$c_homework->isEmpty()){
                        foreach ($c_homework as $C_Homework) {  
                            $C_Homework['user'] = User::find($C_Homework->user_id);
                        }
                        return $c_homework;
                    }
                    return NULL;
                      
                }
                if($request->time == NULL && $request->code != NULL)   //年级-班级-姓名同时筛选，时间筛选为空
                {
                    $user = User::find($request->code);     //查找姓名
                    if($user!=NULL){
                        $c_homework = correct_homework::where([
                            'grade' => $request->grade,
                            'class' => $request->class,
                            'user_id' => $user->id
                        ])->orderBy('created_at', 'desc')->get();   //倒序输出
                        if(!$c_homework->isEmpty()){
                            foreach ($c_homework as $C_Homework) {  
                                $C_Homework['user'] = User::find($C_Homework->user_id);
                            } 
                            return $c_homework;
                        }
                    }
                    return NULL;
                                    
                }
                //年级-班级-时间同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code==NULL)
                {
                    $Homework=NULL;
                    $c_homework = correct_homework::where([
                    'grade' => $request->grade,
                    'class' => $request->class,
                    ])->orderBy('created_at', 'desc')->get();
                    if(!$c_homework->isEmpty()){
                        $i=0;
                        foreach ($c_homework as $C_Homework) {  
                            if($C_Homework->created_at->toDateString()==$request->time){
                                $C_Homework['user'] = User::find($C_Homework->user_id);
                                $Homework[$i++]=$C_Homework;
                            }
                        }
                        return $Homework;
                    }
                    
                    return NULL;
                }
                //年级-班级-时间-姓名同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code!=NULL)
                {
                    $Homework=NULL;
                    $user = User::find($request->code);
                    if($user!=NULL){
                        $c_homework = correct_homework::where([
                            'grade' => $request->grade,
                            'class' => $request->class,
                            'user_id' => $user->id
                        ])->orderBy('created_at', 'desc')->get();
                        if(!$c_homework->isEmpty()){
                            $i=0;
                            foreach ($c_homework as $C_Homework) { 
                                if($C_Homework->created_at->toDateString()==$request->time){
                                    $C_Homework['user'] = User::find($C_Homework->user_id);
                                    $Homework[$i++]=$C_Homework;
                                } 
                            }    
                            return $Homework;                       
                        }
                    }
                    return NULL;   
                }

                break;

            case 0:    //未处理

                if($request->time == NULL&& $request->code == NULL)   //年级-班级同时筛选，时间筛选为空
                {   
                    $c_homework = correct_homework::where([
                        'grade' => $request->grade,
                        'class' => $request->class,
                        'flag' => 0,
                    ])->orderBy('created_at', 'desc')->get();   //倒序输出
                    if(!$c_homework->isEmpty()){
                        foreach ($c_homework as $C_Homework) {  
                            $C_Homework['user'] = User::find($C_Homework->user_id);
                        }   
                        return $c_homework;                    
                    }
                    return NULL;                   
                }

                if($request->time == NULL && $request->code != NULL)   //年级-班级-姓名同时筛选，时间筛选为空
                {
                    $user = User::find($request->code);
                    if($user != NULL){
                     	$c_homework = correct_homework::where([
                            'grade' => $request->grade,
                            'class' => $request->class,
                            'user_id' => $user->id,
                            'flag' => 0,
                        ])->orderBy('created_at', 'desc')->get();   //倒序输出
                        if(!$c_homework->isEmpty()){
                            foreach ($c_homework as $C_Homework) {  
                                $C_Homework['user'] = User::find($C_Homework->user_id);
                            } 
                            return $c_homework;                          
                        }
                    }
                    return NULL;
                         
                }
                //年级-班级-时间同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code==NULL)
                {
                    $Homework=NULL;
                    $c_homework = correct_homework::where([
                        'grade' => $request->grade,
                        'class' => $request->class,
                        'flag' => 0,
                    ])->orderBy('created_at', 'desc')->get();
                        if(!$c_homework->isEmpty()){
                            $i=0;
                            foreach ($c_homework as $C_Homework) {  
                                if($C_Homework->created_at->toDateString()==$request->time){
                                    $C_Homework['user'] = User::find($C_Homework->user_id);
                                    $Homework[$i++]=$C_Homework;
                                } 
                            }  
                            return $Homework;           
                        }
                    return NULL;     
                }
                //年级-班级-时间-姓名同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code!=NULL)
                {
                    $Homework=NULL;
                    $user = User::find($request->code);
                    if($user != NULL){
                        $c_homework = correct_homework::where([
                            'grade' => $request->grade,
                            'class' => $request->class,
                            'user_id' => $user->id,
                            'flag' => 0,
                        ])->orderBy('created_at', 'desc')->get();
                        if(!$c_homework->isEmpty()){
                            $i=0;
                            foreach ($c_homework as $C_Homework) {  
                                if($C_Homework->created_at->toDateString()==$request->time){
                                    $C_Homework['user'] = User::find($C_Homework->user_id);
                                    $Homework[$i++]=$C_Homework;
                                } 
                            }   
                            return $Homework;                     
                        }
                    }
                    return NULL;   
                }

                break;

            case 1:    //已处理

                if($request->time == NULL&& $request->code == NULL)   //年级班级同时筛选，时间筛选为空
                {
                    $c_homework = correct_homework::where([
                        'grade' => $request->grade,
                        'class' => $request->class,
                        'flag' => 1,
                        ])->orderBy('created_at', 'desc')->get();   //倒序输出
                    if(!$c_homework->isEmpty()){
                        foreach ($c_homework as $C_Homework) {  
                            $C_Homework['user'] = User::find($C_Homework->user_id);
                        }
                        return $c_homework;
                    }
                    return NULL;
                        
                }
                //年级-班级-姓名同时筛选，时间筛选为空
                if($request->time == NULL && $request->code != NULL)   
                {
                    $user = User::find($request->code);
                    if($user != NULL){
                 	    $c_homework = correct_homework::where([
                            'grade' => $request->grade,
                            'class' => $request->class,
                            'user_id' => $user->id,
                            'flag' => 1,
                        ])->orderBy('created_at', 'desc')->get();   //倒序输出
                        if(!$c_homework->isEmpty()){
                            foreach ($c_homework as $C_Homework) {  
                                $C_Homework['user'] = User::find($C_Homework->user_id);
                            }   
                            return $c_homework;                         
                        }
                    }
                    return NULL; 
                }
                //年级-班级-时间同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code==NULL)
                {
                    $Homework =NULL;
                    $c_homework = correct_homework::where([
                        'grade' => $request->grade,
                        'class' => $request->class,
                        'flag' => 1,
                    ])->orderBy('created_at', 'desc')->get();
                    if(!$c_homework->isEmpty()){
                        $i=1;
                        foreach ($c_homework as $C_Homework) {  
                            if($C_Homework->created_at->toDateString()==$request->time){
                                $C_Homework['user'] = User::find($C_Homework->user_id);
                                $Homework[$i++]=$C_Homework;
                            } 
                        }  
                        return $Homework;
                    }
                    return NULL;       
                }
                //年级-班级-时间-姓名同时筛选
                if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&&$request->code!=NULL)
                {
                    $Homework=NULL;
                    $user = User::find($request->code);
                    if($user!=NULL){
                        $c_homework = correct_homework::where([
                        'grade' => $request->grade,
                        'class' => $request->class,
                        'user_id' => $user->id,
                        'flag' => 1,
                        ])->orderBy('created_at', 'desc')->get();
                        if(!$c_homework->isEmpty()){
                            $i=0;
                            foreach ($c_homework as $C_Homework) {  
                                if($C_Homework->created_at->toDateString()==$request->time){
                                    $C_Homework['user'] = User::find($C_Homework->user_id);
                                    $Homework[$i++]=$C_Homework;
                                } 
                            } 
                            return $Homework;
                        }
                    }
                    return NULL;   
                }

                break;
            
        }
    }
    

    public function handle(User $user,Admins_userRequest $request)
    {
        $sum=0;  $no=0;  $yes=0;
        if($request->time == NULL&& $request->code == NULL)   //年级-班级同时筛选，时间筛选为空
        {
            $user_sum = correct_homework::where([
                'grade' => $request->grade,
                'class' => $request->class,
            ])->get();
            if(!$user_sum->isEmpty()){
                foreach ($user_sum as $user) {  //全部
                    $sum++;
                }
                foreach ($user_sum as $user) {  //未处理
                    if($user->flag==0)
                    {
                       $no++; 
                    }
                }
                $yes=$sum-$no;     //已处理
            }
            $a['sum'] = $sum ;
            $a['no'] = $no ;
            $a['yes'] = $yes ;
           
            return $a;
        }
        if($request->time == NULL&& $request->code != NULL)   //年级-班级-姓名同时筛选，时间筛选为空
        {
            $user = User::find($request->code);
            if($user!=NULL){
                $user_sum = correct_homework::where([
                    'grade' => $request->grade,
                    'class' => $request->class,
                    'user_id' => $user->id,
                ])->get();
                if(!$user_sum->isEmpty()){
                    foreach ($user_sum as $user) {  //全部
                        $sum++;
                    }
                    foreach ($user_sum as $user) {  //未处理
                        if($user->flag==0)
                        {
                           $no++; 
                        }
                    }
                    $yes=$sum-$no;     //已处理 
                }
            }
            $a['sum'] = $sum ;
            $a['no'] = $no ;
            $a['yes'] = $yes ;
           
            return $a;
        }
        //年级-班级-时间同时筛选
        if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&& $request->code == NULL)
        {
            $user_sum=NULL;
             $usersum = correct_homework::where([
            'grade' => $request->grade,
            'class' => $request->class,
            ])->get();
            if(!$usersum->isEmpty()){
                $i=0;
                foreach($usersum as $user_homework){
                    if($user_homework->created_at->toDateString()==$request->time){
                        $user_sum[$i++]=$user_homework;
                    } 
                }
                if($user_sum!=NULL){
                    foreach ($user_sum as $user) {  //全部
                        $sum++;
                    }
                    foreach ($user_sum as $user) {  //未处理
                        if($user->flag==0)
                        {
                           $no++; 
                        }
                    }
                    $yes=$sum-$no;                    
                    }
            }
            $a['sum'] = $sum ;
            $a['no'] = $no ;
            $a['yes'] = $yes ;
           
            return $a;
        }
        //年级-班级-时间-姓名同时筛选
        if($request->grade != NULL && $request->class != NULL && $request->time !=NULL&& $request->code != NULL)
        {
            $user_sum=NULL;
            $user = User::find($request->code);
            if($user != NULL){
                 $usersum = correct_homework::where([
                'grade' => $request->grade,
                'class' => $request->class,
                'user_id' => $user->id,
                ])->get();
                if(!$usersum->isEmpty()){
                    $i=0;
                    foreach($usersum as $user_homework){
                        if($user_homework->created_at->toDateString()==$request->time){
                            $user_sum[$i++]=$user_homework;
                        } 
                    }
                    if($user_sum!=NULL){
                        foreach ($user_sum as $user) {  //全部
                            $sum++;
                        }
                        foreach ($user_sum as $user) {  //未处理
                            if($user->flag==0)
                            {
                               $no++; 
                            }
                        }
                        $yes=$sum-$no; 
                        }
                    }
            }
            $a['sum'] = $sum ;
            $a['no'] = $no ;
            $a['yes'] = $yes ;
           
            return $a;
        }
    }
    
    /**
     * 批改作业
     */
    public function correction(Request $request)
    {
        $time = Carbon::today()->toDateString();
        // 创建一条数据
        // $correct = Correct::create([
        //     'user_id' => $request->user_id,
        //     'question_id' => $request->question_id,
        //     // 前端传一个judge（题目对（1）错（0））过来
        //     'judge' => $request->judge,
        //     'subject_id' => $request->subject_id,
        //     'admin_id' => $request->admin_id
        // ]);

        // 更新一条数据
        $correct = Correct::where([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'subject_id' => $request->subject_id,
            'admin_id' => $request->admin_id
        ])->get()->first();
        
        if ($correct->created_at->toDateString() == $time)
        {
            $correct->judge = $request->judge;
            $correct->save();
        }
        return $correct;
    }


    public function mo_u(Request $request)
    {
        $admin=Admin::find($request->admin_id);
        $admin_class = relation_admins_classes::where([
            'admin_id' => $admin->id,
        ])->get()->first();
        if($admin_class!=NULL){  //判断$admin_class是否为空
            $c_homework = correct_homework::where([
                'grade' => $admin_class->grade,
                'class' => $admin_class->class
            ])->orderBy('created_at', 'desc')->get();   //倒序输出
            foreach ($c_homework as $C_Homework) {  
                $C_Homework['user'] = User::find($C_Homework->user_id);
            }   
            return $c_homework;
        }
        return NULL;//找不到用户对应班级或者用户对应班级列表返回空
        
    }

    public function mo_c(Request $request)
    {
        $admin=Admin::find($request->admin_id);
        $admin_class = relation_admins_classes::where([
            'admin_id' => $admin->id,
        ])->get()->first();
        $sum=0;  $no=0;  $yes=0;
        if($admin_class!=NULL){
            $user_sum = correct_homework::where([
                'grade' => $admin_class->grade,
                'class' => $admin_class->class,
            ])->get();
            if(!$user_sum->isEmpty()){
                foreach ($user_sum as $user) {  //全部
                    $sum++;
                }
                foreach ($user_sum as $user) {  //未处理
                    if($user->flag==0)
                    {
                       $no++; 
                    }
                }
                $yes=$sum-$no;     //已处理                
            }   
        }
            $a['sum'] = $sum ;
            $a['no'] = $no ;
            $a['yes'] = $yes ;
           
            return $a;
        
    }
}
