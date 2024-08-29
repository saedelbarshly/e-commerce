<?php

namespace App\Models;

use App\Models\optionTypes;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'option_type_id', 'ordering'];
    public function optionType()
    {
        return $this->belongsTo(optionTypes::class, 'option_type_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option', 'option_id', 'product_id');
    }
    //option values
    public function optionValues()
    {
        return $this->hasMany(optionValue::class, 'option_id');
    }
}
