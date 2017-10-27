<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealTag;
use App\Models\OrganisationTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDeal($uuid)
    {
        $deal = Deal::find($uuid);
        if(Auth::user()->isAssigned($deal->opportunity_id)){
            return view('vendor.deals.deal', [
                'deal' => $deal,
                'opportunity' => $deal->opportunity,
                'user' => Auth::user()
            ]);   
        }else{
            return abort(404);
        }
    }

    public function showDealTag($uuid)
    {
        $deal = Deal::find($uuid);
        if(Auth::user()->isAssigned($deal->opportunity_id)){
            return view('vendor.deals.deal_tag', [
                'deal' => $deal,
                'user' => Auth::user()
            ]);
        }else{
            return abort(404);
        }
    }

    public function postDealTag($uuid, Request $request)
    {
        Validator::make($request->all(), [
            'tag_name' => 'required|string',
            'tag_background_color' => 'required|string',
            'text_color' => 'required|string',
        ])->validate();

        $deal = Deal::find($uuid);
        if(Auth::user()->isAssigned($deal->opportunity_id)){
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
                
                return redirect(route('vendor.deal.tag', $uuid))->withErrors([
                    'alert-success' => 'The tag '.$request->get('tag_name').' has been successfully created.'
                ]);
            }else{
                return redirect(route('vendor.deal.tag', $uuid))->withErrors([
                    'alert-danger' => 'A tag with that name already exists within your organisation, please use that instead'
                ]);
            }
        }else{
            return abort(404);
        }
    }

    public function linkDealTag($uuid, Request $request)
    {
        Validator::make($request->all(), [
            'tag' => 'required|string',
        ])->validate();

        $deal = Deal::find($uuid);
        if(Auth::user()->isAssigned($deal->opportunity_id)){
            $deal_tag = new DealTag();
            $deal_tag->organisation_tag_id = $request->get('tag');
            $deal_tag->deal_id = $uuid;
            $deal_tag->save();

            return redirect(route('vendor.deal.tag', $uuid))->withErrors([
                'alert-success' => 'The tag '.$request->get('tag_name').' has been successfully link to this deal.'
            ]);
        }else{
            return abort(404);
        }
    }

}