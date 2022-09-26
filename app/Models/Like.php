<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable=["user_id","like_type","like_id"];

    public $timestamps=false;

    public function like(){
        return $this->morphTo();
    }
}
