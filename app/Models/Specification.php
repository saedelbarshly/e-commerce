<?php

namespace App\Models;

use App\Models\Product;
use App\Models\specificationTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $table = 'specifications';
    protected $fillable = [
        'name_ar',
        'name_en',
        'ordering',
        'specification_type_id',
    ];
    public function specificationTypes()
    {
        return $this->belongsTo(specificationTypes::class, 'specification_type_id');
    }
    //relation with products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_specifications', 'specification_id', 'product_id');
    }
    public function apiData($lang){
        return [
            'id' => $this['id'],
            'name' => $this['name_'.$lang],
            'ordering' => $this['ordering'],
            'specification_type' => $this->specificationTypes['name_'.$lang],
        ];
    }
}
