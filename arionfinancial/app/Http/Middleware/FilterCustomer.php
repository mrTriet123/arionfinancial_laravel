<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class FilterCustomer
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
        $bit = Session::get('RoleID');
        if($bit == 3)
        {
         return $next($request); 
        }
        else
        {
         return Redirect('/');
        }
    }
}
