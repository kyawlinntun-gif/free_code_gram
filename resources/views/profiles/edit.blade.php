@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 offset-md-2">

            <form action="{{route('profile.update', auth()->id())}}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" value="{{ old('title') ?? $profile->title }}" name="title">

                    @error('title')

                        <small class="form-text text-warning">
                            {{$message}}
                        </small>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" value="{{ old('description') ?? $profile->description }}" name="description">

                    @error('description')

                        <small class="form-text text-warning">
                            {{$message}}
                        </small>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    {{-- <input type="url" class="form-control" id="url" value="{{ old('url') ?? $profile->url }}" name="url"> --}}
                    <input type="text" class="form-control" id="url" value="{{ old('url') ?? $profile->url }}" name="url">

                    @error('url')

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

                <button type="submit" class="btn btn-primary">Edit Profile</button>

            </form>


        </div>

    </div>
</div>
@endsection
