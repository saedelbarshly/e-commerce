<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Repositories\Cart\CartRepository;

class AppServiceProvider extends ServiceProvider
{
  // protected $cart;
  // public function __construct(CartRepository $cart)
  // {
  //   $this->cart = $cart;
  // }
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
    // URL::forceScheme('https');


  }

}
