<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'image',
    ];
    public function photoLink()
    {
      $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
      if ($this->image != '') {
        $image = asset('uploads/blogs/' . $this->id . '/' . $this->image);
      }
      return $image;
    }
}
