<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Opportunity;
use Closure;
class OpportunityNotRejected
{
    public function handle($request, Closure $next)
    {
        $opportunity = Opportunity::find($request->route()->parameter('uuid'));
        if($opportunity){
            if(!$opportunity->isRejected()){
                return $next($request);
            }else{
                if($request->ajax()){
                    return response('This opportunity cannot be edited as it has been rejected.', 500);
                }

                return back()->withErrors([
                    'This opportunity cannot be edited as it has been rejected.'
                ]);
            }
        }

        return abort(404);
    }
}