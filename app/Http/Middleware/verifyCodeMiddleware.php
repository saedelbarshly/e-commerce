<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class verifyCodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      if(Auth::guard()->check()){
        if(Auth::guard()->user()->verifyCode == 0 && Auth::guard()->user()->role == '2'){
          return redirect()->route('account.verify');
        }
        else if(Auth::guard()->user()->verifyCode == 1 && Auth::guard()->user()->role == '2'){
          return redirect()->route('user.login');
        }
      }

        return $next($request);
    }
}
