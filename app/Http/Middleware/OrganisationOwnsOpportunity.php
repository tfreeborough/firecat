<?php

namespace App\Http\Middleware;

use App\Models\Opportunity;
use Closure;
use Illuminate\Support\Facades\Auth;

class OrganisationOwnsOpportunity
{
    public function handle($request, Closure $next)
    {
        $opportunity = Opportunity::find($request->uuid);
        if($opportunity){
            $organisation_id = $opportunity->organisation->id;
            if(Auth::user()->organisation->id === $organisation_id){
                return $next($request);
            }
        }

        return abort(404);
    }
}