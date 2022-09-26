<?php

namespace App\Http\Controllers;

use App\Models\{Quote,QuoteComment};
use App\Models\{User, Like};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function check_tyoe($type, $model_id){
        if($type == 1){
            $model_type="App\Models\Quote";
            $model=Quote::find($model_id);
        }else{
            $model_type="App\Models\QuoteComment";
            $model=QuoteComment::find($model_id);
        }
        return array($model_type, $model);
    }
    public function like($type, $model_id){
        $results   =$this->check_tyoe($type, $model_id);
        $model_type=$results[0];
        $model     =$results[1];

        // user nggak boleh like sendiri
        if(Auth::user()->id == $model->user->id){
            die("0");
        }

        // user nggak boleh like berkali-kali
        if($model->is_liked() == null){     
            Like::create([
                "user_id" => Auth::user()->id,
                "like_id" => $model_id,
                "like_type" => $model_type
            ]);
        }
    }

    public function unlike($type, $model_id){
        $results   =$this->check_tyoe($type, $model_id);
        $model_type=$results[0];
        $model     =$results[1];
        

        // user nggak boleh like berkali-kali
        if($model->is_liked()){     
            Like::where("user_id",Auth::user()->id)
                  ->where("like_id", $model_id)
                  ->where("like_type", $model_type)
                  ->delete();
        }
    }
}
