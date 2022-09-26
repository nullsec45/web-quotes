<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;
    use LikesTrait;

    protected $fillable=["title","slug","subject","user_id"];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(QuoteComment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    

    public function isOwner(){
        if(Auth::guest())
            return false;
        return (Auth::user()->id == $this->user->id);
    }
}
