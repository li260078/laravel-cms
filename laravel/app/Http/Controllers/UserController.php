<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordReserRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
           'only'=>['login','register','loginForm','passwordResetFrom','store','passwordReset']
        ]);
    }

    public function register(){
        return view('user.register');
    }
    public function store(UserRequest $request){
        //dd($request->all());
        $data=$request->all();
        $data['password']=bcrypt($data['password']);
        //$data['email_verified_at']=now();
        User::create($data);
        return redirect()->route('login')->with('success','注册成功');
    }
    public function login(){
        return view('user.login');
    }
    public function loginForm(Request $request){
        $this->validate($request,[
            'email'=>'email',
            'password'=>'required|min:6',
        ],[
            'email.email'=>'请输入正确邮箱',
            'password.required'=>'请输入密码',
            'password.min'=>'密码最少要六位以上',
        ]);
        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials ,$request->remember)) {
            // Authentication passed...
            if ($request->from){
                return redirect($request->from)->with('success','登录成功');
            }else{
                return redirect()->route('home.index')->with('success','登录成功');
            }

        }
        return redirect()->back()->with('danger','用户名或密码不正确');
    }
    //退出登录
    public function logout(){
        \Auth::logout();
        return redirect()->route('home.index');
    }
    //重置密码模板
    public function passwordReset(){
        return view('user.password_reset');
    }
    //重置密码提交
    public function passwordResetFrom(PasswordReserRequest $request){
        $user=User::where('email',$request->email)->first();
        //dd($user);
        if ($user){
            $user->password=bcrypt($request->password);
            $user->save();
            return redirect()->route('login')->with('success','密码修改成功');
        }
        return redirect()->back()->with('danger','该邮箱未注册');
    }
}
