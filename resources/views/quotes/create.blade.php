@extends("layouts.main")

@section("title","Create Quote")

@section("container")
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4 text-center">Create Quote</h1>
            {{old("tags[]")}}
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if(session("tag_error")) <div class="alert alert-danger">{{session("tag_error")}} </div>@endif
            @php if(old("tags")){ $old=old("tags"); } @endphp
            <form method="POST" action="/quotes">
                @csrf
                <div class="row mb-3">
                  <label for="title" class="col-sm-2">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{old("title")}}">
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
                    <textarea class="form-control @error("subject") is-invalid @enderror" id="body" rows="5" name="subject">{{old("subject")}}</textarea>
                        @error("subject")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3" id="tag_wrapper">
                    <label for="tag1" class="col-sm-2">Category 1</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="tag1" name="tags[]">
                            <option value="0">Select category 1</option>                     
                                @foreach($tags as $tag1)
                                    @if(old("tags"))
                                        <option value="{{$tag1->id}}" {{(collect($old[0])->contains($tag1->id)) ? 'selected':'' }}>{{ $tag1->name}} </option>
                                    @else
                                        <option value="{{$tag1->id}}">{{ $tag1->name}} </option>
                                    @endif   
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="tag_wrapper">
                    <label for="tag2" class="col-sm-2">Category 2</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="tag2" name="tags[]">
                            <option value="0">Select category 2</option>
                            @foreach($tags as $tag2)
                              @if(old("tags"))
                                 <option value="{{$tag2->id}}" {{(collect($old[1])->contains($tag2->id)) ? 'selected':'' }}>{{ $tag2->name}} </option>
                              @else
                                  <option value="{{$tag2->id}}">{{ $tag2->name}} </option>
                               @endif     
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="tag_wrapper">
                    <label for="tag3" class="col-sm-2">Category 3</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="tag3" name="tags[]">
                            <option value="0">Select category 3</option>
                            @foreach($tags as $tag3)
                                @if(old("tags"))
                                  <option value="{{$tag3->id}}" {{(collect($old[2])->contains($tag3->id)) ? 'selected':'' }}>{{ $tag3->name}} </option>
                                @else
                                  <option value="{{$tag3->id}}">{{ $tag3->name}} </option>
                                @endif    
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <p>{{var_dump(old("tags"))}}</p> --}}
                <button type="submit" class="btn btn-primary float-end" name="action" value="create">Create</button>
                <button type="submit" class="btn btn-danger float-end me-3" name="action" value="cancel">Cancel</button>

            </form>
        </div>
    </div>
</div>

@endsection