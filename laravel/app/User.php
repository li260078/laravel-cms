<?php

namespace App;

use App\Models\Attachment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function geticonAttribute($key)
    {
       return $key? :asset('');
    }
    public function attachment(){
        return $this->hasMany(Attachment::class);
    }
    public function fans(){
       return $this->belongsToMany(User::class,'followres','user_id','following_id');
    }
    public function following(){
       return $this->belongsToMany(User::class,'followres','following_id','user_id');

    }

}
