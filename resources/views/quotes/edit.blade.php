@extends("layouts.main")

@section("title","Edit Quote")

@section("container")
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 text-center">Edit Quote</h1>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <form method="POST" action="/quotes/{{$quote->id}}">
                @csrf
                @method("put")
                <div class="row mb-3">
                  <label for="title" class="col-sm-2">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{old("title") ?? $quote->title}}">
                    @error("title")
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                   </div>
                </div>
                <div class="row mb-3">
                    <label for="body" class="col-sm-2"> Quote</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error("subject") is-invalid @enderror" id="body" rows="5" name="subject">{{old("subject") ?? $quote->subject}}</textarea>
                        @error("subject")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                @foreach($quote->tags as $oldTags)
                    <div class="row mb-3" id="tag_wrapper">
                        <label for="{{$loop->iteration}}" class="col-sm-2">{{"Categoy ".$loop->iteration}}</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="{{$loop->iteration}}" name="tags[]">
                                <option value="0">{{"Select category ".$loop->iteration}}</option>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{($oldTags->id === $tag->id) ? "selected" : ""}}>{{ $tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary float-end" name="action" value="edit">Save</button>
                <button type="submit" class="btn btn-danger float-end me-3" name="action" value="cancel">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection