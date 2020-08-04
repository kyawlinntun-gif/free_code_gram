@extends('layouts.app')

@section('content')
<div class="post_show">
    <div class="container">
        <div class="row">
          <div class="col-md-8">
            <img src="{{url("/storage/uploads/posts/$post->image")}}" class="img-fluid">
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center">
              <div>
                <img src="{{ auth()->user()->profile->profileImage() }}" alt="" class="rounded-circle" style="max-width: 40px;">
              </div>
              <div class="pl-3">
                <div class="font-weight-bold">
                  <a class="text-dark" href="{{ route('profile.show', auth()->id()) }}">test</a>
                  <a href="#" class="pl-3">Follow</a>
                </div>
              </div>
              {{-- <h3>{{$post->user->username}}</h3>
              <p>{{$post->caption}}</p> --}}
            </div>
            <hr>
            <div>
              <div>
                  <span><a class="text-dark font-weight-bold" href="{{ route('profile.show', auth()->id()) }}">test</a></span> {{ $post->caption }}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
