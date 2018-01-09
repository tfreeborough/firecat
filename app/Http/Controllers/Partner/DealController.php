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
use App\Mail\partner\PartnerTriggerDealLost_PARTNER;
use App\Mail\partner\PartnerTriggerDealWon_PARTNER;
use App\Mail\vendor\PartnerProposedDealUpdate;
use App\Mail\vendor\PartnerTriggerDealLost_VENDOR;
use App\Mail\vendor\PartnerTriggerDealWon_VENDOR;
use App\Models\Deal;
use App\Models\DealUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        return view('partner.deals.deal', [
            'deal' => $deal,
            'opportunity' => $deal->opportunity
        ]);
    }

    public function postDealWon($uuid)
    {
        $deal = Deal::find($uuid);
        $deal->status->pending = false;
        $deal->status->won = true;
        $deal->status->save();
        event(new CreateOpportunityActivity(
            $deal->opportunity,
            Auth::user(),
            Auth::user()->name().' marked '.$deal->opportunity->name.' as Won.',
            null
        ));

        Mail::to($deal->opportunity->partner->email)
            ->queue(new PartnerTriggerDealWon_PARTNER($deal, $deal->opportunity->partner));

        foreach($deal->opportunity->assignees as $assignee){
            Mail::to($assignee->user->email)
                ->queue(new PartnerTriggerDealWon_VENDOR($deal, $assignee->user));
        }

        return redirect(route('partner.deal',$uuid))->with([
            'alert-success' => 'This deal was successfully marked as WON.'
        ]);;
    }

    public function postDealLost($uuid)
    {
        $deal = Deal::find($uuid);
        $deal->status->pending = false;
        $deal->status->won = false;
        $deal->status->save();
        event(new CreateOpportunityActivity(
            $deal->opportunity,
            Auth::user(),
            Auth::user()->name().' marked '.$deal->opportunity->name.' as Lost.',
            null
        ));

        Mail::to($deal->opportunity->partner->email)
            ->queue(new PartnerTriggerDealLost_PARTNER($deal, $deal->opportunity->partner));

        foreach($deal->opportunity->assignees as $assignee){
            Mail::to($assignee->user->email)
                ->queue(new PartnerTriggerDealLost_VENDOR($deal, $assignee->user));
        }

        return redirect(route('partner.deal',$uuid))->with([
            'alert-success' => 'This deal was successfully marked as LOST.'
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
        $deal_update = new DealUpdate();
        $deal_update->deal_id = $uuid;
        $deal_update->user_id = Auth::user()->id;
        $deal_update->type = $request->get('type');
        $deal_update->type_formatted = $request->get('formatted_type');
        $deal_update->proposal = $request->get('implementation_date');
        $deal_update->save();

        foreach($deal->opportunity->assignees as $assignee){
            Mail::to($assignee->user->email)
                ->queue(new PartnerProposedDealUpdate($deal, $assignee->user, $deal_update));
        }

        event(new CreateOpportunityActivity(
            $deal->opportunity,
            Auth::user(),
            Auth::user()->first_name.' '.Auth::user()->last_name.' requested to change the '.$request->get('formatted_type').' of '.$deal->opportunity->name.'.',
            null
        ));

        return response(200);
    }

}