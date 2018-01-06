<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Partner;


use App\Events\CreateOpportunityActivity;
use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{

    public function showDeals()
    {
        return view('partner.deals.index', [
            'deals' => Auth::user()->deals
        ]);
    }

    public function showDeal($uuid)
    {
        $deal = Deal::find($uuid);
        if($deal !== null && Auth::user()->hasOpportunity($deal->opportunity->id)){
            return view('partner.deals.deal', [
                'deal' => $deal,
                'opportunity' => $deal->opportunity
            ]);  
        }
        return redirect(route('partner.deals.index'))->withErrors([
            'alert-warning' => 'You do not have access to view that deal'
        ]);
    }


    public function postRequestImplementationDateChange(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'implementation_date' => 'required|string',
            'type' => 'required',
            'formatted_type' => 'required'
        ])->validate();

        $deal = Deal::find($uuid);
        if($deal !== null && Auth::user()->hasOpportunity($deal->opportunity->id)){
            $deal_update = new DealUpdate();
            $deal_update->deal_id = $uuid;
            $deal_update->user_id = Auth::user()->id;
            $deal_update->type = $request->get('type');
            $deal_update->type_formatted = $request->get('formatted_type');
            $deal_update->proposal = $request->get('implementation_date');
            $deal_update->save();

            Mail::to($deal->opportunity->partner->email)
                ->queue(new PartnerProposedDealUpdate($deal, $deal->opportunity->partner, $deal_update));
            
            event(new CreateOpportunityActivity(
                $deal->opportunity,
                Auth::user(),
                Auth::user()->first_name.' '.Auth::user()->last_name.' requested to change the '.$request->get('formatted_type').' of '.$deal->opportunity->name.'.',
                null
            ));

            return response(200);
        }
        $request->session()->flash('alert-error','There was a problem modifying this Deal Reg');
        return abort(404);
    }

}