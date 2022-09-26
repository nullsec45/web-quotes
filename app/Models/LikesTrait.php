<?php
namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


trait LikesTrait
{

    public function likes(){
        return $this->morphMany(Like::class,"like");
    }

    public function is_liked(){
        if(Auth::user()){
          return $this->likes->where("user_id", Auth::user()->id)->count();
        }
    }
}
