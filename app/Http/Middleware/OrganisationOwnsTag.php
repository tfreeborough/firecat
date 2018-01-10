<?php

namespace App\Http\Middleware;

use App\Models\Opportunity;
use App\Models\OrganisationTag;
use Closure;
use Illuminate\Support\Facades\Auth;

class OrganisationOwnsTag
{
    public function handle($request, Closure $next)
    {
        $tag = OrganisationTag::find($request->tag_id);
        if($tag){
            if(Auth::user()->organisation->id === $tag->organisation->id){
                return $next($request);
            }
        }

        return abort(404);
    }
}