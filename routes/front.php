<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\MyFatoorahController;
use App\Http\Controllers\frontend\blogController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\orderController;
use App\Http\Controllers\admin\SubscribeController;
use App\Http\Controllers\frontend\staticController;
use App\Http\Controllers\frontend\contactController;
use App\Http\Controllers\frontend\profileController;
use App\Http\Controllers\frontend\checkoutController;
use App\Http\Controllers\frontend\ProductsController;
use App\Http\Controllers\frontend\registerController;
use App\Http\Controllers\frontend\wishlistController;
use App\Http\Controllers\frontend\dashboardController;
use App\Http\Controllers\frontend\CategoriesController;
use App\Http\Controllers\frontend\HomeFrontendController;


Route::prefix('user')->group(function () {
  Route::get('/login', [LoginController::class, 'index'])->name('user.login');
  Route::get('/register', [registerController::class, 'index'])->name('user.register');
});



Route::get('/', [HomeFrontendController::class, 'index'])->name('e-commerce.index');

Route::group(['middleware' => ['auth'], 'prefix'=> 'profile'], function () {
  Route::get('/', [profileController::class, 'index'])->name('user.profile');
  Route::get('/edit', [profileController::class, 'edit'])->name('profile.edit');
  Route::post('/update', [profileController::class, 'update'])->name('profile.update');
  Route::get('/editPassword', [profileController::class, 'editPassword'])->name('profile.editPassword');
  Route::post('/updatePassword', [profileController::class, 'updatePassword'])->name('profile.updatePassword');
  Route::get('/addresses', [profileController::class, 'bookAddress'])->name('profile.addresses');
  Route::get('/addresses/remove/{id}', [profileController::class, 'removeAddress'])->name('profile.removeAddress');
  Route::get('/myOrder/{id}', [profileController::class, 'myOrder'])->name('profile.myOrder');
});


Route::get('/productSearch', [ProductsController::class, 'productSearch'])->name('product.productSearch');
Route::prefix('products')->group(function () {
  Route::get('/', [ProductsController::class, 'index'])->name('e-commerce.products');
  Route::get('/{product}', [ProductsController::class, 'show'])->name('product.details');
  Route::post('/productReview', [ProductsController::class, 'productReview'])->name('product.productReview')->middleware('auth');
});
Route::get('/getProductPrice', [ProductsController::class, 'getProductPrice'])->name('e-commerce.getProductPrice');
Route::get('/getPriceAfterOption', [ProductsController::class, 'getPriceAfterOption'])->name('e-commerce.getPriceAfterOption');

Route::prefix('categories')->group(function () {
  Route::get('/', [CategoriesController::class, 'index'])->name('e-commerce.categories');
  Route::get('/{category}', [CategoriesController::class, 'show'])->name('category.show');
});

Route::prefix('cart')->group(function () {
  Route::get('/', [CartController::class, 'index'])->name('e-commerce.cart');
  Route::post('/add', [CartController::class, 'store'])->name('cart.add');
  Route::post('/update/{cart}', [CartController::class, 'update'])->name('cart.update');
  Route::post('/store', [CartController::class, 'cartAjax'])->name('cart.store');
  Route::get('/delete/{cart}', [CartController::class, 'delete'])->name('cart.delete');
  Route::post('/increment/{cart}', [CartController::class, 'increment'])->name('cart.increment');
  Route::post('/decrement/{cart}', [CartController::class, 'decrement'])->name('cart.decrement');

});

Route::group(['middleware' => ['auth'], 'prefix' => 'checkout'], function () {
  Route::get('/', [checkoutController::class, 'index'])->name('e-commerce.checkout');
  Route::get('/testPayment',[MyFatoorahController::class,'index'])->name('myfatoorah');
  Route::get('/callbackPayment',[MyFatoorahController::class,'callback'])->name('myfatoorah.callback');
  Route::post('/store', [checkoutController::class, 'store'])->name('checkout.store');
  Route::post('/applyCoupon', [checkoutController::class, 'applyCoupon'])->name('cart.applyCoupon');
});
Route::group(['middleware' => ['auth'], 'prefix' => 'orders'], function () {
  Route::get('/{order}', [orderController::class, 'orderSuccess'])->name('orders.success');
  Route::get('tracking/{order}', [orderController::class, 'orderTracking'])->name('orders.tracking');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'wishlist'], function () {
  Route::get('/', [wishlistController::class, 'index'])->name('e-commerce.wishlist');
  Route::post('/add', [wishlistController::class, 'addItem'])->name('wishlist.add');
  Route::delete('/delete/{wishlist}', [wishlistController::class, 'delete'])->name('wishlist.delete');
});

Route::get('pages/{id}', [staticController::class, 'index'])->name('e-commerce.pages');
Route::get('/blog', [blogController::class, 'index'])->name('e-commerce.blog');
Route::get('/blog/{blog}', [blogController::class, 'show'])->name('e-commerce.blogDetails');
Route::get('/contact', [staticController::class, 'contact'])->name('e-commerce.contact');
Route::get('/about', [staticController::class, 'about'])->name('e-commerce.about');
Route::get('/404', [staticController::class, 'error'])->name('e-commerce.error');
Route::get('/faqs', [staticController::class, 'faqs'])->name('e-commerce.faqs');
Route::get('/polices', [staticController::class, 'polices'])->name('e-commerce.polices');
Route::get('/dashboard', [dashboardController::class, 'index'])->name('e-commerce.dashboard');

Route::post('/storeMessage', [contactController::class, 'storeMessage'])->name('message.store');
Route::post('/subscribes', [SubscribeController::class, 'store'])->name('subscribes.store');


