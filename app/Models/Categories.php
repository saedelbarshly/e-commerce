<?php

namespace App\Models;

use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'metadata_ar',
        'metadata_en',
        'keywords_ar',
        'keywords_en',
        'image',
        'parent_id',
        'ordering',
        'status',
    ];
    public function photoLink() {

      $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
      if($this->image != ''){
        $image = asset('uploads/categories/' . $this->id . '/' . $this->image);
      }
      return $image;
    }
    public function apiData($lang){
        return [
            'id' => $this['id'],
            'name' => $this['name_'.$lang],
            'description' => $this['description_'.$lang],
            'metadata' => $this['metadata_'.$lang],
            'keywords' => $this['keywords_'.$lang],
            'image' => $this->photoLink(),
            'parent_id' => $this['parent_id'],
            'ordering' => $this['ordering'],
            'status' => $this['status'],
        ];
    }
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function items(){
        return $this->hasMany(Items::class, 'category_id', 'id');
    }
}
