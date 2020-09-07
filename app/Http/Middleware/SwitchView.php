<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;


class SwitchView
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
        if($request->segment(1) == "admin") {
            View::addLocation(resource_path('views/admin'));
        } else {
            View::addLocation(resource_path('views/frontend'));
        }
        return $next($request);
    }
}
