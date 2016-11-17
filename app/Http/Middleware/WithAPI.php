<?php

namespace GMC\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WithAPI {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $username = Auth::user()->username;
        $apiToken = \Illuminate\Support\Facades\Crypt::encrypt($username);

        $opts = ['http' => ['header' => 'User-Agent:MyAgent/1.0\r\n']];
        $context = stream_context_create($opts);

        $getEmployee = file_get_contents('https://api.gramedia-majalah.com/v1/gateway/employee/' . $username . '?token=' . $apiToken, false, $context);
        //$getEmployee = file_get_contents('http://localhost/api/public/v1/gateway/employee/' . $username . '?token=' . $apiToken);
        $employee = collect(json_decode($getEmployee));
        if ($employee->isEmpty() == false) :
            $request->session()->put('api_token', $apiToken);
            $request->session()->put('employee', $employee);
            return $next($request);
        endif;
    }

}
