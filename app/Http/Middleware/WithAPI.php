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

//        $opts = [
//            'http' => [
//                'header' => [
//                    'Access-Control-Allow-Origin:*'
//                ]
//            ]
//        ];
//        $context = stream_context_create($opts);
//        $getEmployee = file_get_contents('https://api.gramedia-majalah.com/v1/gateway/employee/' . $username . '?token=' . $apiToken, false, $context);
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_URL, 'https://api.gramedia-majalah.com/v1/gateway/employee/' . $username . '?token=' . $apiToken);
//        $getEmployee = curl_exec($ch);
//        curl_close($ch);
        
//        header("Access-Control-Allow-Origin: *");
//        header("Access-Control-Allow-Credentials: true");
//        header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
//        header("Access-Control-Max-Age: 604800");
//        header("Access-Control-Request-Headers: x-requested-with");
//        header("Access-Control-Allow-Headers: x-requested-with, x-requested-by");
//        $getEmployee = file_get_contents('https://api.gramedia-majalah.com/v1/gateway/employee/' . $username . '?token=' . $apiToken);
        
        //$getEmployee = file_get_contents('https://api.gramedia-majalah.com/v1/gateway/employee/' . $username . '?token=' . $apiToken);
        $getEmployee = file_get_contents('http://localhost/api/public/v1/gateway/employee/' . $username . '?token=' . $apiToken);
        $employee = collect(json_decode($getEmployee));
        if ($employee->isEmpty() == false) :
            $request->session()->put('api_token', $apiToken);
            $request->session()->put('employee', $employee);
            return $next($request);
        endif;
    }

}
