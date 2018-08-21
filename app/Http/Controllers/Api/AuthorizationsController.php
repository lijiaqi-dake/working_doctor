<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\SocialAuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function socialStore($type, SocialAuthorizationRequest $request)
    {
        if (!in_array($type, ['weixin'])) {
            return $this->response->errorBadRequest();
    	}

        $driver = \Socialite::driver($type);

    	try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);//根据授权码code来获取Token
                $token = array_get($response, 'access_token');//从返回的$response数组中提取access_token给$token
    		}
    		else {
                $token = $request->access_token;
                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
    			}
    		}

            $oauthUser = $driver->userFromToken($token);//根据$token获取信息
        } catch (\Exception $e) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
    	}

        switch ($type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;//从获取的信息中提取unionid如果有就提取出来，没有就置空

                if ($unionid) {
    			$user = User::where('weixin_unionid',$unionid)->first();//unionid不为空找第一个weixin_unionid的值等于unionid的用户
    		} else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();//unionid为空找第一个weixin_openid的值等于oauthUser中openid值的用户
    		}

    		//如果没找到用户，默认创建一个用户。
    		if(!$user){
    			$user = User::create([
    				'nice_name' => $oauthUser->getNickname(),//获取微信账户名赋值给昵称
    				'pic' => $oauthUser->getAvatar(),//获取微信头像
    				'weixin_openid' => $oauthUser->getId(),//获取微信openid
    			]);
    		}

    		break;
    	}

        $token = Auth::guard('api')->fromUser($user);

        return $this->respondWithToken($token)->setStatusCode(201);//认证成功后会返回一个$token
    }


    public function respondWithToken($token){
        return $this->response->array([
            'access_token' => $token,//令牌
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL()*60//过期时间
        ]);
    }

    public function update()//更新token
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()//删除token
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    public function api()
     {
         $echoStr = $_GET["echostr"];
         if($this->checkSignature()){
             echo $echoStr;
             exit;
         }
     }
     //检查签名
     private function checkSignature()
     {
         $signature = $_GET["signature"];
         $timestamp = $_GET["timestamp"];
         $nonce = $_GET["nonce"];
         $token = "weixin";
         $tmpArr = array($token, $timestamp, $nonce);
         sort($tmpArr, SORT_STRING);
         $tmpStr = implode($tmpArr);
         $tmpStr = sha1($tmpStr);
         if($tmpStr == $signature){
             return true;

         }else{
             return false;
         }
     }

}
