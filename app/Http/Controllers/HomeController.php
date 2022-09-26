<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function profile($name=null){
        // return "ok";
        // @dd($name);
        if($name == null)
            $user=User::findOrFail(Auth::user()->id);
        else 
             $user=User::where("name", $name)->select("id","name")->first();
        // @dd($user);

        return view("profile", compact("user"));
    }
}
