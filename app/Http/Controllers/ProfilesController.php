<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileCreateFormRequest;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $follows = (auth()->user())? auth()->user()->following->contains($userId) : false; 

        // dd($follows);
        $user = User::findOrFail($userId);

        $postsCount = Cache::remember('count.posts'. $user->id, now()->addSeconds(30), function () use ($user) {
                            return $user->posts->count();
                        });
        $followersCount = Cache::remember('count.followers'. $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->profile->followers->count();
        });
        $followingsCount = Cache::remember('count.following'. $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->following->count();
        });

        return view('profiles.index', [
          'user' => $user,
          'follows' => $follows,
          'postsCount' => $postsCount,
          'flowersCount' => $followersCount,
          'followingsCount' => $followingsCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $userId)
    {
        $profile = $userId->profile;
        $this->authorize('update', $profile);
        // $profile = auth()->user()->profile;
        return view('profiles.edit', [
          'profile' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileCreateFormRequest $request, User $userId)
    {
        $this->authorize('update', $userId->profile);

        // $userId->profile->update($request->all());
        // if($request->image)
        // {
        //   $imagePath = $request->image->store('uploads', 'public');
        //
        //   $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        //   $image->save();
        //   $data = $request->all();
        //   $userId->profile->update([
        //     'image' => $imagePath,
        //   ]);
        //
        // }
        // $profile = $userId->profile;

        // if($request->hasFile('image')){
        //   $image = $request->file('image');
        //   $filename = time() . '.' . $image->getClientOriginalExtension();
        //   $imagePath = $image->store('uploads', 'public');
        //   Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000)->save();
        //   Image::make($image)->resize(1000, 1000)->save( public_path('storage/public/uploads' . $filename ) );
        //   $profile->image = $imagePath;
        //   $profile->save();
        // };
        // return $imagePath;

        $profile = $userId->profile;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $destinationPath = public_path("storage\uploads\profiles");
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move($destinationPath, $imageName);
            $image = Image::make($imagePath)->fit(1200, 1200);
            $image->save();

            $profile->title = $request->title;
            $profile->description = $request->description;
            if($request->has('url'))
            {
                $profile->url = $request->url;
            }
            $profile->image = $imageName;
            $profile->save();
        }
        else
        {
            $profile->title = $request->title;
            $profile->description = $request->description;
            if($request->has('url'))
            {
                $profile->url = $request->url;
            }
            $profile->save();
        }


        return redirect()->route('profile.show', auth()->id());
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
