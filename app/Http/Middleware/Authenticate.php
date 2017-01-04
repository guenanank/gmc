<?php

namespace GMC\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        
        if(\Illuminate\Support\Facades\Session::get('locked') === true) :
            return redirect('/locked');
        endif;
        
        $username = Auth::user()->username;
        $apiToken = \Illuminate\Support\Facades\Crypt::encrypt($username);

        $client = new \GuzzleHttp\Client;
        //$getEmployee = $client->get('http://localhost/api/public/v1/gateway/employee/' . $username, ['query' => ['token' => $apiToken]]);
        $getEmployee = $client->get(config('target') . '/' . config('version') . '/gateway/employee/' . $username, ['query' => ['token' => $apiToken]]);
        $employee = collect(json_decode($getEmployee->getBody()));
        if ($employee->isEmpty() == false) :
            $request->session()->put('api_token', $apiToken);
            $request->session()->put('employee', $employee);
            
            return $next($request);
        else :
            return redirect()->guest('login');
        endif;
    }
}
