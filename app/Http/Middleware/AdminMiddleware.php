<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $is_allow= false;
        $user_id= session()->get('user_id');
        if(!is_null($user_id)){
            $is_allow= true;
        }
        if(!$is_allow){
            return redirect('/');
        }

        return $next($request);
    }
}
