<?php

namespace App\Models;

use App\Models\Categories;
use App\Models\Menu;
use App\Models\Pages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'title_ar',
        'title_en',
        'type',
        'mainElement',
        'link',
        'category_id',
        'page_id',
        'menu_id',
    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id');
    }
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
  public function itemRoute()
  {
    $route = '';
    if ($this->type == 'category') {
      if ($this->category->id != null) {
        $route = route('e-commerce.products', ['category_id[]' => $this->category->id]);
      }
    }
    if ($this->type == 'staticPage') {
      $route = route('e-commerce.pages', ['id' => $this->page->id]);
    }
    if ($this->type == 'link') {
      $route = $this->link;
    }
    return $route;
  }


    public function subItems()
    {
      return $this->hasMany(Items::class, 'mainElement');
    }


}
