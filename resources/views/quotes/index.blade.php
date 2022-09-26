@extends("layouts.main")

@section("title","Quotes")

@section("container")
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 text-center">List Quotes</h1>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
       
        <div class="col-md-8">
          @if(session("msg"))
            <div class="alert alert-success">
                <p>{{session("msg")}}</p>
            </div>
          @endif
          <a href="/quotes/random" class="btn btn-primary">Random</a>
          <div class="dropdown d-inline">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach($tags as $tag)
                  <li><a class="dropdown-item" href="/quotes/category/{{$tag->name}}">{{$tag->name}}</a></li>
                @endforeach
            </ul>
          </div>
          <form action="/" method="get" class="mt-3">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Quote Search" name="search">
              <button class="btn btn-success" type="submit" id="search">Search</button>
            </div>
          </form>

          @foreach($quotes as $quote)
          <div class="card mb-3">
            <div class="card-body">
               Judul Quote : {{$quote->title}}
              <span class="badge bg-primary float-end"><a href="/quotes/{{$quote->slug}}" class="text-white text-decoration-none">Show</a></span>
            </div>
          </div>
          @endforeach
          
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection