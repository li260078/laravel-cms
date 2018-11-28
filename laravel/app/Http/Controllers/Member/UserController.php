<?php

namespace App\Http\Controllers\Member;

use App\Models\Article;
use App\Models\Zan;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'only'=>['edit','update','attention']
        ]);
    }
    public function show(User $user)
    {
        //dd($user);
        $articles= Article::latest()->where('user_id',$user->id)->paginate(5);
        return view('memder.user.show',compact('user','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,Request $request)
    {

        $this->authorize('isMine',$user);
        $type=$request->query('type');
        return view('memder.user.edit_'.$type,compact('user'));
    }


    public function update(Request $request, User $user)
    {       //dd($user);
        //dd($request->all());

        $this->authorize('isMine',$user);
        $data=$request->all();
       //$data['password']= bcrypt($data['password']);
       //dd($data);
        $this->validate($request,[
            //sometimes：只有地址栏里有password的参数才会拦截
            'password'=>'sometimes|required|min:6|confirmed',
            'name'=>'sometimes|required'
        ],[
            'password.required'=>'请输入密码',
            'password.min'=>'密码不能少于六位数',
            'password.confirmed'=>'两次密码不一致',
            'name.required'=>'请输入昵称',
        ]);
        //判断参数里面有password才执行加密
        if ($request->password){
            $data['password']= bcrypt($data['password']);
        };
        //执行更新
        //dd($data);
        $user->update($data);
        return back()->with('success','操作成功');

    }

   public function attention(User $user){
        $user->fans()->toggle(auth()->user());
        return back();
   }
   public function interestList(User $user){
            //dd($user);
        $fans= $user->fans()->paginate(12);
        //dd($fans);
        return view('memder.user.interestList',compact('user','fans'));
   }
   public function fanList(User $user){
        //dd($model);
       $fans= $user->following()->paginate(12);
       //dd($fans->toArray());
        return view('memder.user.fanList',compact('user','fans'));
   }

   public function myZan(User $user,Request $request,Zan $zan){
        $type=$request->query('type');
          // $data=[];
           $zansData=$user->zan()->where('zan_type','App\Models\\'.ucfirst($type))->paginate(1);
          // dd($zansData);
        return view('memder.user.my_zan_'.$type,compact('user','zansData','zans'));
   }
}
