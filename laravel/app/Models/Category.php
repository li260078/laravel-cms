<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
      'title','icon'
    ];
    //多对一关联
    public function article(){
        return $this->hasMany(Article::class);
    }
}
