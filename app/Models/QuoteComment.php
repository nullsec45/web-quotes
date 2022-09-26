<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteComment extends Model
{
    use HasFactory;
    use LikesTrait;
    
    protected $fillable=["subject","user_id","quote_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quote(){
        return $this->belongsTo(Quote::class);
    }
    
    public function isOwner(){
        if(Auth::guest())
            return false;
        return (Auth::user()->id == $this->user->id);
    }
}
