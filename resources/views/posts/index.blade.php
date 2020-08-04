@extends('layouts.app')

@section('content')
<div class="post_show">
    @foreach ($posts as $post)
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <img src="{{url("/storage/uploads/posts/$post->image")}}" class="img-fluid">
                </div>
                <div class="col-md-4 offset-2 pt-2 pb-4">
                    <div>
                        <span><a class="text-dark font-weight-bold" href="{{ route('profile.show', $post->user_id)}}">test</a></span> {{ $post->caption }}
                    </div>
                </div>                                                                     
            </div>
            <div class="row">
                <div class="col-md-8 d-flex justify-content-center">{{ $posts->links() }}</div>
            </div>
        </div>
    @endforeach
</div>
@endsection
