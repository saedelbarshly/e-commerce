<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
  public function get() : Collection;
  public function add(Product $product, $quantity = 1, $price, $options = [], $imagePath = '');
  public function update($id, $quantity, $options);
  public function delete($id);
  public function clear();
  public function total(): float;
  public function applyCoupon($coupon);
}
