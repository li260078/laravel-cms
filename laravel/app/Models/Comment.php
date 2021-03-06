<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function zan(){
        return $this->morphMany(Zan::class,'zan');
    }
    public function collect(){
        return $this->morphMany(Collect::class,'collect');
    }
    public function article(){
        return$this->belongsTo(Article::class);
    }
}
