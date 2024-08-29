<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productSpecialOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'priority',
        'start_date',
        'end_date',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
