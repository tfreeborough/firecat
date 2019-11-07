<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use Closure;
class EmailVerified
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isVerified()){
            return $next($request);
        }

        return back()->withErrors([
            'Sorry, but you cannot perform that action until you verify your email. If you need to resend your code you can do so <a href="'.route('resend-verification').'">here.</a>'
        ]);
    }
}