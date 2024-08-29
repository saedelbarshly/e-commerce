<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'name_ar',
        'name_en',
        'image',
        'ordering',
        'keywords_ar',
        'keywords_en',
    ];
    public function photoLink() {

      $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
      if($this->image != ''){
        $image = asset('uploads/companies/' . $this->id . '/' . $this->image);
      }
      return $image;
    }
    public function apiData($lang){
        return [
            'id' => $this['id'],
            'name' => $this['name_'.$lang],
            'image' => $this->photoLink(),
            'ordering' => $this['ordering'],
            'keywords' => $this['keywords_'.$lang],
        ];
    }
}
