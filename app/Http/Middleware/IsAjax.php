<?php

namespace GMC\Http\Middleware;

use Closure;

class IsAjax
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax()) :
            return $next($request);
        endif;
        
//        return response()->json(['message' => 'SEX!'], 404);
        return abort(404);
    }

}