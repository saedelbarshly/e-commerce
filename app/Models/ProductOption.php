<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $guarded = [];
    protected $table = 'product_option';
    public function options()
    {
        return $this->hasMany(ProductOptionItems::class, 'product_option_id');
    }
    public function originalOption()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
}