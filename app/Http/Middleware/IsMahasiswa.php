<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsMahasiswa
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
        if(Auth::user()->role == 'Mahasiswa')
            return $next($request);
        return redirect('/');
    }
}
