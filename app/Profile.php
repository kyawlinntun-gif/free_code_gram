<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
      'title', 'description', 'url', 'img'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
      // return '/storage/' . ($this->image) ? ($this->image) : "/uploads/profiles/1024px-No_image_available.svg.web"; 
      $imagePath = $this->image ? $this->image : '/1024px-No_image_available.svg.webp'; 
      return '/storage/uploads/profiles/'. $imagePath;
    }

    public function followers()
    {
      return $this->belongsToMany(User::class);
    }
}
