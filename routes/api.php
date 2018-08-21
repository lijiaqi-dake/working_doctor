<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api=app('Dingo\Api\Routing\Router');

$api->version('v1',[
	'namespace' => 'App\Http\Controllers\Api'
],function ($api){
    $api->group([//限制调用频率的接口
		'middleware' => 'api.throttle',
		'limit' => config('api.rate_limits.sign.limit'),
		'expires' => config('api.rate_limits.sign.expires'),
	],function($api){
        // 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizatizons.store');
        
        //解除当前用户的微信绑定
        $api->post('user','UsersController@destory')->name('api.user.destory');

        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
             ->name('api.authorizations.destroy');



        //pc端管理员登录接口
            $api->post('admin','AdminsController@store')
            ->name('api.admin.store');
        //pc端管理员退出接口
            $api->delete('admin','AdminsController@destroy')
            ->name('api.admin.destroy');
        //pc端管理员退出接口
            $api->post('admin/judge','AdminsController@Judge')
            ->name('api.admin.judge.Judge');       
        //pc端管理员个人信息
            $api->get('admin','AdminsController@show')
            ->name('api.admin.show');
        //pc端管理员默认学生列表
            $api->post('admin/{admin_id}/mo_user','Admins_userController@mo_u')
            ->name('api.admin.mo_user.mo_u');
        //pc端管理员默认学生列表
            $api->post('admin/{admin_id}/mo_correct','Admins_userController@mo_c')
            ->name('api.admin.mo_correct.mo_c');         
        //pc端管理员所管理班级的学生列表接口
            $api->post('admin/user','Admins_userController@show')
            ->name('api.admin.user.show');
        //pc端管理员作业是否处理信息接口
            $api->post('admin/user/deal','Admins_userController@handle')
            ->name('api.admin.user.deal.handle');
        //pc端管理员题目查找接口
            $api->post('admin/search','QuestionController@search_question')
            ->name('api.admin.search.search_question');
        //pc端管理员题目查找确定为今天作业接口
            $api->post('admin/search/add','QuestionController@search_add_question')
            ->name('api.admin.search.add.search_add_question');
        //pc端管理员题目录入接口
            $api->post('admin/add','QuestionController@add_question')
            ->name('api.admin.add.add_question');
        //pc端管理员作业题目列表接口
            $api->get('admin/{user_id}/homework','HomeworkController@show')
             ->name('api.admin.homework.show');
        //pc端管理员确定已批改接口
            $api->get('admin/sure/{user_id}','HomeworkController@make_sure')
            ->name('api.admin.sure.make_sure');
        // pc端管理员批改作业接口
             $api->post('admin/user/correction','Admins_userController@correction')
             ->name('api.admin.user.correction');
        //作业批改界面的个人信息
        $api->get('homework/{user_id}','HomeworkController@index')->name('api.homework.index');


        //需要token验证的接口
        $api->group(['middleware' => 'api.auth'],function($api){
        	//需要验证的api接口写在这里
        });


        
        //注册时填写的用户信息
        $api->post('users','UsersController@update')->name('api.users.update');
		//用户个人信息
		$api->get('user', 'UsersController@me')
            ->name('api.user.show');
        
        //获取用户的教师队伍
        $api->get('user/teacher','UsersController@TeacherPhone')->name('api.user.teacher.TeacherPhone');
        
        //获取班级家长队伍
        $api->get('class','classController@show')->name('api.class.show');
        
        //用户修改信息
	    $api->patch('registers','RegistersController@update')
            ->name('api.registers.update');
            
        //通知列表,当notice_type为homework为作业通知，当notice_type=other_notice时为其他通知
        $api->get('notices/{notice_type}','NoticesController@show')->name('api.notices.show');

        //学生学情报告列表
        $api->get('reports/student','ReportsController@studentShow')->name('api.reports.student.studentShow');


        // 教师学情报告列表
        $api->get('reports', 'ReportsController@show')->name('api.reports.show');
        //作业详情与提交
        $api->get('notice','NoticesController@update')->name('api.notice.update');

        //具体通知的详情,notice_id为统治的id
        $api->get('notice/{notice_id}','NoticesController@NowShow')->name('api.notice.NowShow');

        //反馈
        $api->post('feedback','FeedbackController@create')->name('api.feedback.create');

        $api->post('/','AuthorizationsController@api')->name('api');
	});
});
