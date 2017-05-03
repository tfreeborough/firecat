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

        $loginController = new LoginController();
        $loginController->logout($request);

        return redirect('login')->withErrors([
            'Sorry, but you have not yet verified your account. Please do so before logging in. If you need to resend your code you can do so <a href="'.route('resend-verification').'">here.</a>'
        ]);
    }
}