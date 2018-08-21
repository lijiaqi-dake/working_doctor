<?php

namespace App\Http\Controllers\Api;

use Session;
use App\Models\Admin;
use App\Models\relation_admins_classes;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AdminRequest;
use App\Transformers\AdminTransformer;
use Auth;
use App\Transformers\Admins_classesTransformer;

class AdminsController extends Controller
{

	public function __construct()
    {
		// $this->middleware('guest:admin',['except'=>'store']);
		// $this->middleware('auth', [            
        //     'except' => ['store']
        // ]);
    }


    public function store(Request $request,Admin $admin)
    {
	
	$credentials = $request->only('account','password');
       //用户认证
       if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) { 	
			
			$request->session()->put('admin_code', $request->account);

		    $admins = Auth::guard('admin')->user();		//登陆成功返回当前登陆用户的信息   
			// $value = $request->session()->get('admin_code');
			$value = $request->session()->all();
			$admins['admin_code']=$value;
		    // $admins['session_id']=$_COOKIE['PHPSESSID'];
				// session(['user'=>'kk']);
            //    return session()->get('user');
            return $admins;
		} else {// 登录失败后的相关操作 
		   session()->flash('danger', '账号和密码不匹配');
		   // return redirect()->back();
		   return 0;
		}
    
	}


	public function destroy(Request $request)
    {
		if(Auth::guard('admin')->user()){
			$request->session()->flush();   //将session清除
			// session(['admin_code'=>NULL]);
			// Auth::guard('admin')->logout();

			// $value = $request->session()->all();
			// return $value;
			// return 1;
		}
        // session()->flash('success', '您已成功退出！');
		// return redirect('login'); 页面定向
		
		$value = $request->session()->all();
        return $value;
	}


	public function Judge(Request $request)
    {
		$value = session()->get('admin_code');
		if($value != NULL){
            return 1;
		}
		else{
			return 0;
		}
		// return $value;
	}
	

	public function show(Admin $admin,Request $request)
    {

		// if($request->session()->has('admin')) return 0;
		
		$admin = Auth::guard('admin')->user();
		// $admin = auth()->guard('admin');
		// return $admin->id;
		// return $this->response->item($admin, new AdminTransformer());
		return $admin;


	}

	
}
