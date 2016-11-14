<?php

namespace GMC\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WithAPI
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
        $username = Auth::user()->username;
        $apiToken = \Illuminate\Support\Facades\Crypt::encrypt($username);
        $getEmployee = file_get_contents('http://localhost/api/public/gateway/employee/' . $username . '?token=' . $apiToken);
        $employee = collect(json_decode($getEmployee));
        if($employee->isEmpty() == false) :
            $request->session()->put('api_token', $apiToken);
            $request->session()->put('employee', $employee);
            return $next($request);
        endif;
        
    }
}
