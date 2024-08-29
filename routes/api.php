<?php

use App\Http\Controllers\api\AuthinticationController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\CompaniesController;
use App\Http\Controllers\api\CouponsController;
use App\Http\Controllers\api\CurrenciesController;
use App\Http\Controllers\api\DimensionsController;
use App\Http\Controllers\api\ForgetPasswordController;
use App\Http\Controllers\api\OrdersController;
use App\Http\Controllers\api\paymentMethodsController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\SocialLoginController;
use App\Http\Controllers\api\SpecificationsController;
use App\Http\Controllers\api\StaticPagesController;
use App\Http\Controllers\api\TaxesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *
 * //authintication routes
 *
 */
Route::post('/register',[AuthinticationController::class, 'register']);
Route::post('/login', [AuthinticationController::class, 'login']);
Route::post('/forgetPassword', [ForgetPasswordController::class, 'forgetPassword']);
Route::post('/checkcode', [ForgetPasswordController::class, 'checkcode']);
Route::post('/ResetPassword', [ForgetPasswordController::class, 'ResetPassword']);
//social login
Route::post('/socialLogin', [SocialLoginController::class, 'socialLogin']);

Route::group(['middleware' => ['api']], function () {
    Route::get('generalSettings', [StaticPagesController::class, 'generalSettings']);
    Route::get('pages', [StaticPagesController::class, 'pages']);
    Route::get('currencies', [CurrenciesController::class, 'index']);
    Route::get('currencies', [CurrenciesController::class, 'index']);
    Route::get('length', [DimensionsController::class, 'length']);
    Route::get('width', [DimensionsController::class, 'width']);
    Route::get('taxRate', [TaxesController::class, 'taxRate']);
    Route::get('taxType', [TaxesController::class, 'taxType']);
    Route::get('taxCost', [TaxesController::class, 'taxCost']);
    Route::get('companies', [CompaniesController::class, 'index']);
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('specificationTypes', [SpecificationsController::class, 'specificationTypes']);
    Route::get('specifications', [SpecificationsController::class, 'specifications']);
    Route::get('coupons', [CouponsController::class, 'index']);
    Route::get('products', [ProductsController::class, 'index']);
    Route::get('products/{product}', [ProductsController::class, 'show']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthinticationController::class, 'logout']);
    Route::post('/updateUser', [AuthinticationController::class, 'updateUser']);
    Route::post('/updatePassword', [AuthinticationController::class, 'updatePassword']);

  Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrdersController::class, 'myOrdersList']);
    Route::get('/getShippingRate', [OrdersController::class, 'getShippingRate']);
    Route::post('/create', [OrdersController::class, 'createOrder']);
    Route::get('/{OrderId}/details', [OrdersController::class, 'OrderDetails']);
    });

  Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [OrdersController::class,'addToCart']);
    Route::get('/myCart', [OrdersController::class, 'myCart']);
    Route::get('/removeItem/{id}', [OrdersController::class, 'removeItem']);
    Route::post('/editItem/{id}', [OrdersController::class, 'editItem']);
    Route::post('/addCoupon', [OrdersController::class, 'addCoupon']);
    Route::get('/removeCoupon', [OrdersController::class, 'removeCoupon']);
  });

  Route::group(['prefix' => 'user'], function(){
    Route::group(['prefix' => 'paymentMethods'], function () {
      Route::get('/', [paymentMethodsController::class, 'index']);
      Route::post('/create', [paymentMethodsController::class,'create']);
      Route::get('/{paymentMethod}/details', [paymentMethodsController::class, 'show']);
      Route::post('/{paymentMethod}/update', [paymentMethodsController::class,'update']);
      Route::get('/{paymentMethod}/delete', [paymentMethodsController::class, 'delete']);
    });
  });
});


/**
 *
 * //user routes
 *
 */
// Route::group(['prefix'=>'user'], function(){
//     Route::get('/my-profile','api\UserController@myProfile');
//     Route::post('/update-my-profile','api\UserController@UpdateMyProfile');
//     Route::get('/deleteAccount','api\UserController@deleteAccount');
//     Route::get('/myNotification','api\UserController@myNotification');
//     Route::get('/markNotificationsAsRead','api\UserController@markNotificationsAsRead');

//     Route::group(['prefix'=>'address'], function(){
//         Route::get('/','api\UserController@myAddressList');
//         Route::post('/create','api\UserController@createAddress');
//         Route::get('/{addressId}/details','api\UserController@AddressDetails');
//         Route::post('/{addressId}/update','api\UserController@UpdateAddress');
//         Route::get('/{addressId}/delete','api\UserController@DeleteAddress');
//     });


//     Route::group(['prefix'=>'favorites'], function(){
//         Route::get('/','api\UserController@myFavoriteList');
//         Route::post('/create','api\UserController@createFavorite');
//         Route::get('/{FavoriteId}/delete','api\UserController@DeleteFavorite');
//     });



// });

