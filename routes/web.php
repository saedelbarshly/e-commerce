<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\frontend\Auth\AccountVerfiy;
use App\Http\Controllers\frontend\HomeFrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeFrontendController::class,'index' ])->name('home');

Route::get('/testStripe', function () {
    return view('stripe');
});
Route::post('/testStripe', function () {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    Stripe\Charge::create ([
            "amount" => 100 * 150,
            "currency" => "inr",
            "source" => request()->stripeToken,
            "description" => "Making test payment."
    ]);

    Session::flash('success', 'Payment has been successfully processed.');

    return back();
})->name('stripe.payment');
Route::get('SwitchLang/{lang}',function($lang){
    session()->put('Lang',$lang);
    app()->setLocale($lang);
    if (auth()->check()) {
        $user = App\Models\User::find(auth()->user()->id)->update(['language'=>$lang]);
    }
	return Redirect::back();
});
Route::get('user/{email}/{lang}',function($email,$lang){
    $user = App\Models\User::where('email',base64_decode($email))->first()->update(['active'=>1]);
    if ($lang == 'ar') {
        $html = '<div dir="rtl" style="padding-top:30px;font-size:16px;text-align:center;">';
        $html .= 'تم تفعيل حسابك بنجاح';
        $html .= '<br><a href="#" dir="rtl" style="padding:10px 20px;font-size:16px;text-align:center;">اضغط هنا لتسجيل الدخول</a>';
        $html .= '</div>';
        return $html;
    } else {
        $html = '<div dir="rtl" style="padding-top:30px;font-size:16px;text-align:center;">';
        $html .= 'your account activated successfully';
        $html .= '<br><a href="#" dir="rtl" style="padding:10px 20px;font-size:16px;text-align:center;">click here to login</a>';
        $html .= '</div>';
        return $html;
    }

})->name('user.ativate.account');





require __DIR__.'/admin.php';
require __DIR__.'/front.php';
Auth::routes();

Route::get("/account/verfiy", [AccountVerfiy::class, 'showVerfiyForm'])->name("account.verify");
Route::post("/account/verfiy", [AccountVerfiy::class, 'verfiy'])->name("account.verify");
Route::post("resent/code/verfiy", [AccountVerfiy::class, 'resentCode'])->name("resent.verify");

Route::get('/home', [HomeController::class, 'index'])->name('home');
