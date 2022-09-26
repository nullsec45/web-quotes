@extends("layouts.main")

@section("title","Quotes")

@section("container")
<div class="container">
    <div class="row justify-content-center mt-4">
       <div class="col-md-8">
         <div class="card">
            <div class="card-header">
                {{$quote->title}}
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{$quote->subject}}</p>
                <footer class="blockquote-footer"><a style="color:inherit" class="text-decoration-none" href="/profile/{{$quote->user->name}}">{{$quote->user->name}}</footer>
                @foreach($quote->tags as $tag)
                  <span class="badge bg-success">{{$tag->name}}</span>
                @endforeach
              </blockquote>
              <div class="like_wrapper">
                <span class="like {{$quote->is_liked() ? "text-primary" : "text-black"}}" data-model-id="{{$quote->id}}" data-type="1"><i class="fa-solid fa-thumbs-up mt-3" style="font-size:30px"></i></span> 
                <span class="like_number">
                  {{$quote->likes->count()}}
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2 form-comment">
      <div class="col-md-8">
        @if(Auth::user())
        <form action="/quotes/comment/{{$quote->id}}" method="POST">
          @csrf
          <div class="form-floating">
            <textarea class="form-control @error("comment") is-invalid @enderror" placeholder="Leave a comment here" id="comment" style="height: 100px" name="comment">{{old("comment")}}</textarea>
            <label for="comment">Comments</label>
          </div>
          <button class="btn btn-primary mt-2" style="width:100%">Comment</button>
       </form>
       @endif
       <div>
        <h4 class="mt-3">Comment</h4>
         @foreach($quote->comments as $comment)     
          <div class="border ps-3 mt-2 pb-3">
            <h5><a href="/profile/{{$comment->user->name}}" style="color:inherit;text-decoration:none;">{{"@".$comment->user->name}}</a></h5>
            <p>{{$comment->subject}}</p>
            @if($comment->isOwner())
            <span>
              <a href="/quotes/comment/{{$comment->id}}/edit" class="text-black text-decoration-none">Edit</a> 
              <form action="/quotes/comment/{{$comment->id}}" method="POST" class="d-inline">@csrf @method("DELETE") 
                <button class="text-black text-decoration-none border-0 bg-white">Delete</button>
              </form>
            </span>
            @endif
            <span class="like {{$comment->is_liked() ? "text-danger" : "text-black"}}" data-model-id="{{$comment->id}}" data-type="2" style="cursor:pointer;">
              {{$comment->is_liked() ? "Unlike" : "Like"}}
            </span> 
            
         </div>
        @endforeach
       </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <a href="/" class="btn btn-primary mt-3">Back</a>
        @if($quote->isOwner())
          <div class="d-inline">            
            <a href="/quotes/{{$quote->id}}/edit" class="btn btn-warning mt-3 float-end">Edit</a>
            <form action="/quotes/{{$quote->id}}" class="d-inline" method="POST">
              @csrf
              @method("delete")
              <button  onclick="return confirm('Data yakin ingin dihapus?')" class="btn btn-danger mt-3 me-2 float-end">Delete</a>
            </form>
            
          </div>
        @endif
      </div>
    </div>
</div>
@php
  $notif_model::where("user_id", $user->id)->where("seen",0)->update(["seen" => 1]);
@endphp
@endsection