<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 00:27
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{

    public function showOpportunity($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            return view('vendor.opportunities.opportunity', [
                'opportunity' => Opportunity::find($uuid),
                'user' => Auth::user()
            ]);
        }
        return abort(404);

    }

}