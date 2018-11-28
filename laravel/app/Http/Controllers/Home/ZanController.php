<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
           'only'=>['make']
        ]);
    }

    public function make(Request $request){
        //dd($request->all());
        $type=$request->query('type');
        //dd($type);
        $id=$request->query('id');
        //dd($id);
        $class='App\Models\\'.ucfirst($type);
        //dd($class);
        $model=$class::find($id);
        //dd($model);
        $zan=$model->zan->where('user_id',auth()->id())->first();
        if ($zan){
            $zan->delete();
        }else{
            $model->zan()->create(['user_id'=>auth()->id()]);
        }

        //判断是否为ajax请求
        if ($request->ajax()){
            $model=$class::find($id);
            return ['code'=>1,'message'=>'','zan_num'=>$model->zan->count()];
        }

        return back();
    }


}
