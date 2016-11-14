<?php

namespace GMC\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next) {
        if ($request->secure() == false && env('APP_ENV') === 'prod') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }

}
