<?php

namespace App\Models;

use App\Models\Option;
use App\Models\optionTypes;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optionValue extends Model
{
    use HasFactory;
    protected $table = 'option_values';
    protected $fillable = [
        'name_ar',
        'name_en',
        'option_id',
        'option_type_id',
        'ordering',
    ];
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
    public function optionType()
    {
        return $this->belongsTo(optionTypes::class, 'option_type_id');
    }
    //relation with product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option', 'option_value_id', 'product_id');
    }
}
