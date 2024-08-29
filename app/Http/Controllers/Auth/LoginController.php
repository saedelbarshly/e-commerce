<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use App\Repositories\Cart\CartRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
      if (auth()->user()->role == '1') {
        return route('admin.index');
      } else {
        return route('index');
      }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->middleware('guest')->except('logout');
      $this->cart = $cart;
    }

  public function login(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

      if (Auth::attempt($request->only('email', 'password'))) {
        if (auth()->user()->checkActive() != '1') {
          session()->put('faild', auth()->user()->checkActive());
          auth()->logout();
          return redirect()->back()->withInput();
        }
        if (auth()->user()->role == '1') {
          return redirect()->route('admin.index');
        } else {
          if (count(getCart()['items']) > 0) {
            foreach (getCart()['items'] as $key => $value) {
              addToCart(auth()->user()->id,$value);
            }
            session()->forget('cartItems');
            return redirect()->route('e-commerce.checkout');
          }
          return redirect()->route('e-commerce.index');
        }
      } else {
        session()->put('faild', trans('auth.failed'));
        return redirect()->back()->withInput();
      }
    }
    public function showLoginForm()
    {
      $title = trans('common.e-commerce');
      return view('AdminPanel.auth.login', [
        'active' => '',
        'title' => $title,
      ], compact('title'));
    }
    protected function loggedOut(Request $request)
    {
      return redirect()->route('e-commerce.index');
    }
}
