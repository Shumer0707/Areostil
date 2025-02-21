<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Если передан новый язык, обновляем session и cookie
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            Session::put('locale', $locale);
            return $next($request)->withCookie(cookie()->forever('lang', $locale));
        }

        // ✅ Если язык уже есть в session — используем его
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        // ✅ Если нет, пробуем взять из cookie
        elseif ($request->cookie('lang')) {
            $locale = $request->cookie('lang');
            Session::put('locale', $locale);
        }
        // ✅ Если ничего нет, ставим ru
        else {
            $locale = 'ru';
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
