<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:46
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VendorAdmin
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && Auth::user()->isVendorAdministrator(Auth::user()->organisation->id)){
            return $next($request);
        }

        return abort(404);
    }
}