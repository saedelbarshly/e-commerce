<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemOptions extends Model
{
    //
    protected $guarded = [];
    protected $table = 'order_item_options';
    public function productOption()
    {
        return $this->belongsTo(ProductOptionItems::class,'product_option_id');
    }
}
