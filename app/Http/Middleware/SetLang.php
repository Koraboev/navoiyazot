<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $languages = ['ru', 'en', 'uz'];
        $lang = session('lang', 'ru');
        if (in_array($request->segment(1), $languages)) {
            session(['lang' => $request->segment(1)]);
            App::setLocale($request->segment(1));
            return $next($request);
        }


        App::setLocale($lang);
        return $next($request);
    }
}
