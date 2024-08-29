<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        date_default_timezone_set('Asia/Dubai');
        if ($request->hasHeader("lang")) {
            /**
             * If lang header found then set it to the default locale
             */
            App::setLocale($request->header("lang"));
        } else {
            $locale = $request->session()->get('Lang');
            if ($locale !== null && in_array($locale, config('app.locales'))) {
                App::setLocale($locale);
            }
            if ($locale === null) {
                $request->session()->put('Lang',config('app.locale'));
            }
        }
        return $next($request);
    }
}