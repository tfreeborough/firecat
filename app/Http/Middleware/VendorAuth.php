<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:46
 */

namespace App\Http\Middleware;

use Closure;
class VendorAuth
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isVendor()){
            return $next($request);
        }

        return redirect('login');
    }
}