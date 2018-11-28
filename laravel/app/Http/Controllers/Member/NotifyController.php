<?php

namespace App\Http\Controllers\Member;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotifyController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'only'=>['show','index']
        ]);
    }
    public function index(User $user){
        $this->authorize('isMine',$user);
        $notifycations=$user->notifications()->get();
        //dd($notifycations);
        return view('memder.notify.index',compact('user','notifycations'));
    }
    public function show(DatabaseNotification $notify){
        $notify->markAsRead();
        return redirect(route('home.article.show',$notify['data']['article_id']));
    }
}
