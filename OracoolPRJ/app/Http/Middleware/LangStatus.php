<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class LangStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (session('language')) {
            app()->setLocale(session('language'));
            Log::info("Lingua: " . App::getLocale() . ", Fuso orario: " . Carbon::now()->timezoneName);     
        } 

        return $next($request);
    }

}
