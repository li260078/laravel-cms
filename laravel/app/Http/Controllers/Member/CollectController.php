<?php

namespace App\Http\Controllers\Member;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
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
        $zan=$model->collect->where('user_id',auth()->id())->first();
        if ($zan){
            $zan->delete();
        }else{
            $model->collect()->create(['user_id'=>auth()->id()]);
        }
        return back();
    }
    public function index(User $user,Request $request){
        $type=$request->query('type');
        //dd($type);
        $collects=    $user->collect()->paginate(5) ;
        return view('memder.collect.index_'.$type,compact('user','collects'));
    }
}
