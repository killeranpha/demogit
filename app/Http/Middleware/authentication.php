<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class authentication
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
		$chucnang = DB::table('chucnangs')
		->where('route', Route::currentRouteName())
		->first();
		if(isset($chucnang->id)){
			$quyen = DB::table('nguoidungchucnangs')
			->where('nguoidungid', Auth::user()->id)
			->where('chucnangid', $chucnang->id)
			->first();
			if($quyen && $quyen->nguoidungid==Auth::user()->id){
				return $next($request);
			}else{
				return redirect('khongcoquyen');
			}
		}else{
			return redirect('khongcoquyen');
		}
    }
}
