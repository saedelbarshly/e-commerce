<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'product_images';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
