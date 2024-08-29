<?php

namespace App\Models;

use App\Models\Option;
use App\Models\optionCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optionTypes extends Model
{
    use HasFactory;
    protected $table = 'option_types';
    protected $fillable = [
        'name_ar',
        'name_en',
        'option_category_id',
    ];
    public function optionCategories()
    {
        return $this->belongsTo(optionCategories::class, 'option_category_id');
    }
    public function options()
    {
        return $this->hasMany(Option::class, 'option_type_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option', 'option_type_id', 'product_id');
    }

}
