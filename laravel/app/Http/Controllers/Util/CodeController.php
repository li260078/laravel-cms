<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//验证码类
class CodeController extends Controller
{
    public function send(Request $request){
        //dd($request->all());
        //获取随机验证码
        $code=$this->random();
        //发送验证码
        $user=User::firstOrNew(['email'=>$request->username]);
        //dd($user);
        //创建通知类
        $user->notify(new RegisterNotify($code));
        //将验证码存入到session中
        session()->put('code',$code);
        //返回数据
        return ['code'=>1,'message'=>'验证码发送成功'];
    }
    //生成四位随机验证码
    public function random($len=4){
        $str='';
        for ($i=0;$i<$len;$i++){
            $str .=mt_rand(0,9);

        }
        return $str;
    }
}
