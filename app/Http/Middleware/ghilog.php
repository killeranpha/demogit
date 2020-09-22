<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ghilog
{
    public function handle($request, Closure $next)
    {
		$stdout = fopen('php://stdout', 'w');
		fwrite($stdout,"Start " . Route::currentRouteName() . " " . date("Y-m-d H:i:s.u")."\n");
		
        $r = $next($request);
		
		fwrite($stdout,"End " . Route::currentRouteName() . " " . date("Y-m-d H:i:s.u")."\n");
		
		//echo Auth::user()->email;
		
		// trả về không có quyền
		return $r;
    }
}
