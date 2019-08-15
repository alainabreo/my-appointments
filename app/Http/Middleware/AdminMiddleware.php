<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        $url = $request->getRequestUri();
        if (auth()->user()->role == 'admin')
            return $next($request);

        $forbidden = 'You do not have allowed access to '. $url .' !!!';
        return redirect('/home')->with(compact('forbidden'));
    }
}
