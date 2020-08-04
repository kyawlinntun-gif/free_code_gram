@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3 p-5 text-center">
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle img-fluid">
        </div>

        <div class="col-md-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center mb-3">
                    <div class="h4 pr-3">{{ $user->username }}</div>
                    {{-- <button class="btn btn-primary">Follow</button> --}}
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                  <a href="{{ url('p/create') }}">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
              <a href="{{route('profile.edit', $user->id)}}">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postsCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $flowersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingsCount }}</strong> following</div>
            </div>
            <div class="font-weight-bold pt-3">{{$user->profile->title}}</div>
            <div>
                {{$user->profile->description}}
            </div>
            <div>
                {{-- <a href="#" class="font-weight-bold">{{$user->profile->url ?? 'N/A'}}</a> --}}
                <a href="#" class="font-weight-bold">{{$user->profile->url}}</a>
            </div>
        </div>

    </div>



    <div class="row pt-5">

        @foreach($user->posts as $post)

            <div class="col-md-4">
                <a href="{{ url("p/show/$post->id") }}">
                    <img src="{{ url("storage/uploads/posts/$post->image") }}" class="img-fluid">
                </a>
            </div>

        @endforeach

    </div>
</div>
@endsection
