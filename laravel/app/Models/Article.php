<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{   //一对多关联
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function zan(){
        return $this->morphMany(Zan::class,'zan');
    }
    public function collect(){
        return $this->morphMany(Collect::class,'collect');
    }
}
