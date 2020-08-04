@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 offset-md-2">

            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="post_caption">Post Caption</label>
                    <input type="text" class="form-control" id="post_caption" value="{{ old('caption') }}" name="caption">

                    @error('caption')

                        <small class="form-text text-warning">
                            {{$message}}
                        </small>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Post Image</label>
                    <input type="file" class="form-control" id="image" name="image">

                    @error('image')

                        <small class="form-text text-warning">
                            {{$message}}
                        </small>

                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>


        </div>

    </div>
</div>
@endsection
