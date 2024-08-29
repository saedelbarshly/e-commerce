<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Str;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'carts';
    protected $fillable =[
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'price',
        'options',
        'total'
    ];
    protected static function booted(){
        // static::creating(function(Cart $cart){
        //     $cart->id = Str::uuid();
        // });
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id', function(Builder $builder){
          $builder->where('cookie_id', Cart::getCookieId());
        });
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id')->withDefault([
          'name' => 'anonymous'
        ]);
    }
  public  static function getCookieId()
  {
    $cookie_id = Cookie::get('cookie_id');
    if (!$cookie_id) {
      $cookie_id = Str::uuid();
      Cookie::queue('cookie_id', $cookie_id, 60 * 24 * 30);
    }
    return $cookie_id;
  }

}
