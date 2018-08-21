<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Storage;
use App\Models\Notice;
use App\Models\correct_homework;
use App\Models\User;
use App\Models\relation_admins_classes;
use App\Transformers\NoticeTransformer;

class NoticesController extends Controller
{
    public function show($notice_type)
    {
        $user = $this->user();//获取当前用户
        $notice = Notice::where([
            'grade' => $user->grade,
            'class' => $user->class,
            'notice_type' => $notice_type,
            ])->orderBy('created_at', 'desc')->get();//获取所有对应用户班级的通知
        return $this->response->item($notice,new NoticeTransformer());//返回作业的信息

    }

    // public function upload(Request $request)
    // {
    //     // $user = $this->user();
    //     // $nowCorrect = Correct
        
    // 	//接收表单提交的文件，file为表单的name
	// 	$file=$request->file('file');
    //     //判断是否为合法文件
	// 	if($file->isValid ()){
    //         //通过laravel自带的store方法进行文件的上传，其中第一个参数表示上传到哪个文件夹下，第二个参数为用哪个磁盘，也就是框架下面的filesystem.php里面的配置
	// 		$path=$file->store (date ('ymd'),'upload');
	// 		return ['file' => asset('uploadImages/'.$path), 'code' => 0];
	// 	}else{
	// 		return ['message' => '上传失败', 'code' => 403];
	// 	}
    // }


    public function update(Request $request)
    {
        // //接收表单提交的文件，file为表单的name
		// $file=$request->file('file');
        // //判断是否为合法文件
		// if($file->isValid ()){
        //     //通过laravel自带的store方法进行文件的上传，其中第一个参数表示上传到哪个文件夹下，第二个参数为用哪个磁盘，也就是框架下面的filesystem.php里面的配置
		// 	$path=$file->store (date ('ymd'),'upload');
		// 	$img = ['file' => asset('uploadImages/'.$path), 'code' => 0];
		// }else{
		// 	$img = ['message' => '上传失败', 'code' => 403];
		// }
         $user = $this->user();
         $class = User::find($user->id)->class;
         $grade = User::find($user->id)->grade;
         $adminId = relation_admins_classes::where([
             'class' => $class,
             'grade' => $grade,
         ])->get()->first();//取出的数据的第一个
         $nowCorrect = correct_homework::create([
             'user_id' => $user->id,
            //  'img_url' => $img['file'],//照片的路径
            'img_url' => $request->name,
            //  'correct' => false,
             'admin_id' => $adminId->admin_id,
            //  'question_id' => 1,
            //  'subject_id' => 1,
            //  'judge' => false,
            'class' => $class,
            'grade' => $grade,
             'corrected' => false,
         ]);

         return $nowCorrect;
        // return $adminId;
    }



    public function NowShow($notice_id)
    {
        return Notice::find($notice_id);
    }
}
