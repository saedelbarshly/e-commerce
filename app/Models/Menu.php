<?php

namespace App\Models;

use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'title_ar',
        'title_en',
        'place',
    ];
    public function items()
    {
        return $this->hasMany(Items::class, 'menu_id');
    }
}
