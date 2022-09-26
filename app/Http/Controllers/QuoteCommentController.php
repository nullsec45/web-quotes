<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Notification, Quote,QuoteComment,User};

class QuoteCommentController extends Controller
{
  
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
       $this->validate($request, [
        "comment" => "required|min:5"
       ]);
       $quote=Quote::findOrFail($id);

       $quotes=QuoteComment::create([
        "subject" => $request->comment,
        "user_id" => Auth::user()->id,
        "quote_id" => $id
       ]);

       if($quote->user->id != Auth::user()->id){    
        Notification::create([
            "user_id" => $quote->user->id,
            "quote_id" => $id,
            "subject" => "New comment from ".Auth::user()->name
        ]);
       }
       
       return redirect("/quotes/".$quote->slug);

    }

    public function edit($id)
    {
        $comment=QuoteComment::findOrFail($id);
        return view("quotes.comment",  compact("comment"));
    }

    public function update(Request $request, $id)
    {
        $comment=QuoteComment::findOrFail($id);

        if($request->input("action") == "cancel"){
            return redirect("/quotes/".$comment->quote->slug);
        }
     
        if($comment->isOwner()){
            $this->validate($request, ["subject" => "required|min:5|max:500"]);
            $comment->update(["subject" => $request->subject]);
        }else{
            abort(403);
        }
        // echo "ok";
        return redirect("/quotes/".$comment->quote->slug);
    }

    public function destroy($id)
    {
        $comment=QuoteComment::findOrFail($id);
        if($comment->isOwner())
            $comment->delete(); 
        else abort(403);

        return redirect("/quotes/".$comment->quote->slug);
    }
}
