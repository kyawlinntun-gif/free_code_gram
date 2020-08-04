<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PostCreateFormRequest;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateFormRequest $request)
    {
        // dd($request->all());
        // return auth()->id();

        // return $imagePath = request('image')->store('uploads', 'public');
        // return $imagePath = $request->image->store('uploads', 'public');
        
        // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        // $image->save();

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $destinationPath = public_path("storage\uploads\posts");
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move($destinationPath, $imageName);
            $image = Image::make($imagePath)->fit(1200, 1200);
            $image->save();
        }

        auth()->user()->posts()->create([
            'caption' => $request->caption,
            'image' => $imageName,
        ]);

        return redirect()->action('ProfilesController@index', auth()->id());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts/show', [
          'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
