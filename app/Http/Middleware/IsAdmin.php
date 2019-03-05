<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
		if (in_array('admin', Auth::user()->roles()->pluck('name')->toArray())) {
			return $next($request);
		}

		return redirect('/posts')->with(['error' => 'Доступ тільки для адміністратора']);
    }
}
