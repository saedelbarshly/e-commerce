<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionItems extends Model
{
    protected $guarded = [];
    protected $table = 'product_option_items';
    public function originalOptionValue()
    {
        return $this->belongsTo(optionValue::class, 'option_value_id');
    }
}