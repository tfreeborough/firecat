<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:46
 */

namespace App\Http\Middleware;

use Closure;
class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isAdmin()){
            return $next($request);
        }

        return redirect('login');
    }
}