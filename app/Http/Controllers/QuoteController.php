<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\{Notification, Quote,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    
    public function index(Request $request)
    {
        $search_q=urlencode($request->input("search"));

        $tags=Tag::all();
        if(!empty($search_q))
            $quotes=Quote::with("tags")->where("title","like","%".$search_q."%")->get();
        else
            $quotes=Quote::with("tags")->get();
        return view("quotes.index", compact("quotes","tags"));
    }

    public function category($tag){

        $tags=Tag::all();
        $quotes=Quote::with("tags")->whereHas("tags", function($query) use ($tag){
            $query->where("name", $tag);
        })->get();
        return view("quotes.index", compact("quotes","tags"));
    }


    public function create()
    {
        $tags=Tag::all();
        return view("quotes.create", compact("tags"));
    }

    public function store(Request $request)
    {
        // @dd($request->tags);
        if($request->input("action") == "cancel"){
            return redirect("/");
        }
        
        $this->validate($request, ["title" => "required|min:3","subject" => "required|min:10|max:500"]);

        $request->tags=array_unique(array_diff($request->tags, [0]));
        if(empty($request->tags))
            return redirect("quotes/create")->withInput($request->input())->with("tag_error","category cannot be empty");

        $slug=Str::slug($request->title,"-");

        if(Quote::where("slug", $slug)->first() !== null)
            $slug=$slug."-".time();

        $quote=Quote::create(["title" => $request->title,
                                "slug" => $slug,
                                "subject" => $request->subject,
                                "user_id" => Auth::user()->id                    
        ]);
        
   

        $quote->tags()->attach($request->tags);
        return redirect("/profile")->with("msg","Quote successfully created");
    }

    public function show($slug)
    {
        $quote=Quote::with("comments.user","tags")->where("slug", $slug)->first();
        $user=Auth::user();
        $notifications=Notification::where("user_id", $user->id)->orderBy("id","desc")->get();
        $notif_model=new Notification;

        if(empty($quote)){
            abort(404);
        }

        return view("quotes.single", compact("quote","notifications","notif_model", "user"));
    }

    public function edit($id)
    {
        $quote=Quote::findOrFail($id);
        $tags=Tag::all();

        if($quote->isOwner()){  
             return view("quotes.edit", compact("quote","tags"));
        }else{
            abort("403");
        }
    }

    public function update(Request $request, $id)
    {
        $quote=Quote::findOrFail($id);

        if($request->input("action") == "cancel"){
            return redirect("/quotes");
        }
        if($quote->isOwner()){
            $this->validate($request, ["title" => "required|min:3","subject" => "required|min:10|max:500"]);
                  
            $request->tags=array_diff($request->tags, [0]);
            if(empty($request->tags))
                return redirect("quotes/create")->withInput($request->input())->with("tag_error","category cannot be empty");
                
            $quote->tags()->sync($request->tags);
            
            $quote->update(["title" => $request->title, "subject" => $request->subject]);
        }else{
            abort(403);
        }
        
        return redirect("/")->with("msg","Quote successfullly updated");
    }

    public function destroy($id)
    {
        $quote=Quote::findOrFail($id);

        if($quote->isOwner()){
            $quote->delete();
        }else{
            abort(403);
        }
        
        return redirect("/")->with("msg","Quote successfully deleted");
    }

    public function random(){
        $quote=Quote::inRandomOrder()->first();
        $user=Auth::user();
        $notifications=Notification::where("user_id", $user->id)->orderBy("id","desc")->get();
        $notif_model=new Notification;
        return view("quotes.single", compact("quote", "user","notif_model"));
    }


}
