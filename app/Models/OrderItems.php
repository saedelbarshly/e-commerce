<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    //
    protected $guarded = [];


    public function typeText()
    {
        $text = trans('common.'.$this->type);
        return $text;
    }

    public function options()
    {
        return $this->hasMany(OrderItemOptions::class,'order_item_id');
    }

    public function optionsArr() {
      $options = [];
      if ($this->options->count() > 0) {
        foreach ($this->options as $option_key => $option_value) {
          $options[$option_value['product_option_id']] = $option_value['product_option_value_id'];
        }
      }
      return $options;
    }

    public function optionsTotal() {
      return $this->options()->count() > 0 ? $this->options()->sum('price') : 0;
    }

    public function totals()
    {
        $price = ($this->total+$this->optionsTotal()) * $this->quantity;
        return $price;
    }
    
    public function apiData($lang,$currency = null)
    {
        if ($currency == '') {
            $totals = [
                'total' => $this->total,
                'price' => $this->price
            ];
        } else {
            $curruncy = Currencies::find($currency);
            if ($curruncy != '') {
                $totals = [
                    'total' => round($this->total/$curruncy->transfer_rate),
                    'price' => round($this->price/$curruncy->transfer_rate)
                ];
            } else {
                $totals = [
                    'total' => $this->total,
                    'price' => $this->price
                ];
            }
        }

        $data = [
            'id' => $this->id,
            'price' => $totals['price'],
            'quantity' => $this->quantity,
            'total' => $totals['total'],
            'quantity' => $this->quantity,
        ];
        return $data;
    }
    public function subOrder()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }


}
