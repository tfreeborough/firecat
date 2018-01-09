<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PartnerHasOpportunity
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasOpportunity($request->uuid)){
            return $next($request);
        }

        return abort(404);
    }
}