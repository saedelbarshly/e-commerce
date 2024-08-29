<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productDiscount extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'price',
        'start_date',
        'end_date',
        'priority',
        'product_id'
    ];
    public function products()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    
}
