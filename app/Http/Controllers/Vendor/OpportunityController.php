<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 00:27
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\Assignee;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class OpportunityController extends Controller
{

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
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


    /**
     * @param $uuid
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \Exception
     */
    public function assignOpportunity($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(!Auth::user()->isAssigned($uuid)){
                $assignee = new Assignee();
                $assignee->id = Uuid::generate();
                $assignee->opportunity_id = $uuid;
                $assignee->user_id = Auth::user()->id;
                $assignee->save();

                $opportunity = Opportunity::find($uuid);
                if(count($opportunity->assignees) === 0){
                    $opportunity->status->associated = true;
                    $opportunity->status->save();
                }
                return view('vendor.opportunities.opportunity', [
                    'opportunity' => $opportunity,
                    'user' => Auth::user()
                ]);
            }else{
                return view('vendor.opportunities.opportunity', [
                    'opportunity' => Opportunity::find($uuid),
                    'user' => Auth::user()
                ])->withErrors([
                    'You are already assigned to this opportunity'
                ]);
            }
        }
        return abort(404);
    }

}