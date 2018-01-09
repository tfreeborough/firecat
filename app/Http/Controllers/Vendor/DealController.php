<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Vendor;


use App\Events\CreateOpportunityActivity;
use App\Http\Controllers\Controller;
use App\Mail\partner\VendorAcceptedDealUpdate;
use App\Mail\partner\VendorRejectedDealUpdate;
use App\Mail\RequestDealUpdate;
use App\Mail\partner\VendorTriggerDealLost_PARTNER;
use App\Mail\vendor\VendorTriggerDealLost_VENDOR;
use App\Mail\partner\VendorTriggerDealWon_PARTNER;
use App\Mail\vendor\VendorTriggerDealWon_VENDOR;
use App\Models\Deal;
use App\Models\DealTag;
use App\Models\DealUpdate;
use App\Models\OrganisationTag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDeal($uuid)
    {
        $deal = Deal::find($uuid);
        return view('vendor.deals.deal', [
            'deal' => $deal,
            'opportunity' => $deal->opportunity,
            'user' => Auth::user()
        ]);
    }

    public function acceptDealUpdate($uuid, $update_id)
    {
        $deal = Deal::find($uuid);
        $deal_update = DealUpdate::find($update_id);
        if($deal_update !== null && $deal_update->isValid()){
            $opportunity = $deal->opportunity;
            if($deal_update->isTime()){
                $opportunity[$deal_update->type] = Carbon::createFromFormat('d/m/Y',$deal_update->proposal);
            }else{
                $opportunity[$deal_update->type] = $deal_update->proposal;
            }
            $opportunity->save();
            event(new CreateOpportunityActivity(
                $deal->opportunity,
                Auth::user(),
                Auth::user()->name().' accepted a proposed update to change the '.$deal_update->type_formatted.' of '.$deal->opportunity->name.'.',
                null
            ));

            Mail::to($deal->opportunity->partner->email)
                ->queue(new VendorAcceptedDealUpdate($deal, $deal->opportunity->partner, $deal_update));

            $deal_update->delete();

            return redirect(route('vendor.deal',$uuid))->with([
                'alert-success' => 'Deal update was successfully accepted.'
            ]);
        }
        return redirect(route('vendor.deal',$uuid))->withErrors([
            'alert-error' => 'This deal update has already been accepted or rejected'
        ]);
    }

    public function rejectDealUpdate($uuid, $update_id)
    {
        $deal = Deal::find($uuid);
        $deal_update = DealUpdate::find($update_id);
        if($deal_update !== null && $deal_update->isValid()){
            event(new CreateOpportunityActivity(
                $deal->opportunity,
                Auth::user(),
                Auth::user()->name().' rejected a proposed update to change the '.$deal_update->type_formatted.' of '.$deal->opportunity->name.'.',
                null
            ));

            Mail::to($deal->opportunity->partner->email)
                ->queue(new VendorRejectedDealUpdate($deal, $deal->opportunity->partner, $deal_update));

            $deal_update->delete();
            return redirect(route('vendor.deal',$uuid))->with([
                'alert-success' => 'Deal update was successfully rejected.'
            ]);
        }
        return redirect(route('vendor.deal',$uuid))->withErrors([
            'alert-error' => 'This deal update has already been accepted or rejected'
        ]);
    }

    public function showDealTag($uuid)
    {
        $deal = Deal::find($uuid);
        return view('vendor.deals.deal_tag', [
            'deal' => $deal,
            'user' => Auth::user()
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
            ->queue(new VendorTriggerDealWon_PARTNER($deal, $deal->opportunity->partner));

        foreach($deal->opportunity->assignees as $assignee){
            Mail::to($assignee->user->email)
                ->queue(new VendorTriggerDealWon_VENDOR($deal, $assignee->user));
        }

        return redirect(route('vendor.deal',$uuid))->with([
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
            ->queue(new VendorTriggerDealLost_PARTNER($deal, $deal->opportunity->partner));

        foreach($deal->opportunity->assignees as $assignee){
            Mail::to($assignee->user->email)
                ->queue(new VendorTriggerDealLost_VENDOR($deal, $assignee->user));
        }

        return redirect(route('vendor.deal',$uuid))->with([
            'alert-success' => 'This deal was successfully marked as LOST.'
        ]);;
    }

    public function postDealRequestUpdate($uuid)
    {
        $deal = Deal::find($uuid);
        Mail::to($deal->opportunity->partner->email)
            ->queue(new RequestDealUpdate($deal->opportunity->partner, $deal, Auth::user()));
        return redirect(route('vendor.deal',$deal->id))->with([
            'alert-info' => 'A request for information has been successfully sent to the partner of this deal ('.$deal->opportunity->partner->email.').'
        ]);
    }
    
    public function postDealTag($uuid, Request $request)
    {
        Validator::make($request->all(), [
            'tag_name' => 'required|string',
            'tag_background_color' => 'required|string',
            'text_color' => 'required|string',
        ])->validate();

        if(OrganisationTag::where('name','=',$request->get('tag_name'))->first() === null){
            $organisation_tag = new OrganisationTag();
            $organisation_tag->name = $request->get('tag_name');
            $organisation_tag->color = $request->get('tag_background_color');
            $organisation_tag->text_color = $request->get('text_color');
            $organisation_tag->organisation_id = Auth::user()->organisation->id;
            $organisation_tag->user_id = Auth::user()->id;
            $organisation_tag->save();

            $deal_tag = new DealTag();
            $deal_tag->organisation_tag_id = $organisation_tag->id;
            $deal_tag->deal_id = $uuid;
            $deal_tag->save();

            return redirect(route('vendor.deal.tag', $uuid))->with([
                'alert-success' => 'The tag '.$request->get('tag_name').' has been successfully created.'
            ]);
        }else{
            return redirect(route('vendor.deal.tag', $uuid))->withErrors([
                'alert-danger' => 'A tag with that name already exists within your organisation, please use that instead'
            ]);
        }
    }

    public function linkDealTag($uuid, Request $request)
    {
        Validator::make($request->all(), [
            'tag' => 'required|string',
        ])->validate();

        if(!DealTag::where([
            ['deal_id','=',$uuid],
            ['organisation_tag_id','=',$request->get('tag')]
        ])->first()){
            $deal_tag = new DealTag();
            $deal_tag->organisation_tag_id = $request->get('tag');
            $deal_tag->deal_id = $uuid;
            $deal_tag->save();

            return redirect(route('vendor.deal.tag', $uuid))->with([
                'alert-success' => 'The tag '.$request->get('tag_name').' has been successfully link to this deal.'
            ]);
        }

        return redirect(route('vendor.deal.tag', $uuid))->withErrors([
            'alert-error' => 'The tag '.$request->get('tag_name').' is already associated with this deal.'
        ]);
    }

    public function unlinkDealTag($uuid, Request $request)
    {
        Validator::make($request->all(), [
            'tag' => 'required|string',
        ])->validate();

        $deal_tag = DealTag::find($request->get('tag'));
        $deal_tag->delete();
        return redirect(route('vendor.deal.tag', $uuid))->with([
            'alert-success' => 'You have successfully unlinked this tag from the deal.'
        ]);
    }

}