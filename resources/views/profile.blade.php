@extends("layouts.main")

@section("title","Edit Quote")

@section("container")
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 text-center">{{ucfirst($user->name)}}</h1>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-md-8">
        @if(session("msg"))
        <div class="alert alert-success">
            <p>{{session("msg")}}</p>
        </div>
        @endif
        @if(Auth::user())
            <a href="{{route("logout")}}" class="btn btn-danger">Logout</a>
            <a href="/quotes/create" class="btn btn-success">Create</a>
        @endif
        @foreach($user->quotes as $quote)
        <div class="card mb-3 mt-2">
            <div class="card-body">
                Judul Quote : {{$quote->title}}
                <span class="badge bg-primary float-end"><a href="/quotes/{{$quote->slug}}" class="text-white text-decoration-none">Show</a></span>
            </div>
        </div>
        @endforeach
      </div>
    </div>
</div>
@endsection