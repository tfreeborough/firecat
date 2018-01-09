<?php

namespace App\Http\Middleware;

use App\Models\Deal;
use Closure;
use Illuminate\Support\Facades\Auth;

class OrganisationOwnsDeal
{
    public function handle($request, Closure $next)
    {
        $deal = Deal::find($request->uuid);
        if($deal){
            $organisation_id = $deal->opportunity->organisation->id;
            if(Auth::user()->organisation->id === $organisation_id){
                return $next($request);
            }
        }

        return abort(404);
    }
}