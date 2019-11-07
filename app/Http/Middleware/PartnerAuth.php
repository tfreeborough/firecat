<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:46
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PartnerAuth
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isPartner()){
            return $next($request);
        }

        return redirect('login');
    }

}