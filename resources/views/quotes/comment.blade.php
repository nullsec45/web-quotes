@extends("layouts.main")

@section("title","Edit Quote")

@section("container")
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 text-center">Edit Comment</h1>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <form method="POST" action="/quotes/comment/{{$comment->id}}">
                @csrf
                @method("put")
                <div class="row mb-3">
                    <label for="body" class="col-sm-3">Fill in the comments</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error("subject") is-invalid @enderror" id="body" rows="5" name="subject">{{old("title") ?? $comment->subject}}</textarea>
                        @error("subject")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                  </div>
                <button type="submit" class="btn btn-primary float-end" name="action" value="edit">Save</button>
                <button type="submit" class="btn btn-danger float-end me-3" name="action" value="cancel">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection