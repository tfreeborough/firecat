<?php

namespace App\Http\Middleware;

use App\Models\Deal;
use App\Models\Opportunity;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserAssignedDeal
{
    public function handle($request, Closure $next)
    {
        $deal = Deal::find($request->uuid);
        if($deal){
            if(Auth::user()->isAssigned($deal->opportunity->id)){
                return $next($request);
            }   
        }
        
        return back()->withErrors([
            'You cannot perform that action as you are not assigned to the opportunity of this deal.'
        ]);
    }
}