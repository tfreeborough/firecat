<?php

namespace App\Http\Middleware;

use App\Models\Deal;
use Closure;
use Illuminate\Support\Facades\Auth;

class PartnerHasDeal
{
    public function handle($request, Closure $next)
    {
        $deal = Deal::find($request->uuid);
        if($deal){
            if(Auth::user()->hasOpportunity($deal->opportunity->id)){
                return $next($request);
            }
        }

        return abort(404);
    }
}