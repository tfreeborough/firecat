<?php

namespace App\Http\Middleware;

use App\Models\Opportunity;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserAssignedOpportunity
{
    public function handle($request, Closure $next)
    {
        $opportunity = Opportunity::find($request->uuid);
        if($opportunity){
            if(Auth::user()->isAssigned($opportunity->id)){
                return $next($request);
            }
        }


        return back()->withErrors([
            'You cannot perform that action as you are not assigned to the opportunity.'
        ]);
    }
}