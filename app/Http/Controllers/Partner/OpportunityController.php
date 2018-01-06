<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 00:27
 */

namespace App\Http\Controllers\Partner;


use App\Events\CreateOpportunityActivity;
use App\Http\Controllers\Controller;
use App\Mail\vendor\PartnerSentThreadMessage;
use App\Models\Opportunity;
use App\Models\OpportunityConsideration;
use App\Models\OpportunityProduct;
use App\Models\OpportunityStatus;
use App\Models\OpportunityThreadMessage;
use App\Models\Organisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class OpportunityController extends Controller
{

    public function showOpportunities()
    {
        return view('partner.opportunities.index', [
            'opportunities' => Auth::user()->opportunities
        ]);
    }
    
    public function showOpportunity($uuid)
    {
        if(Auth::user()->hasOpportunity($uuid)){
            return view('partner.opportunities.opportunity', [
                'opportunity' => Opportunity::find($uuid)
            ]);
        }
        return abort(404);

    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showThreads($uuid)
    {
        if(Auth::user()->hasOpportunity($uuid)){
            return view('partner.opportunities.threads', [
                'opportunity' => Opportunity::find($uuid),
                'user' => Auth::user()
            ]);
        }
        return abort(404);

    }

    public function postCreateThread($uuid, Request $request)
    {
        if(Auth::user()->hasOpportunity($uuid)){
            Validator::make($request->all(), [
                'subject' => 'required|string',
            ])->validate();

            $thread = new OpportunityThread();
            $thread->subject = $request->get('subject');
            $thread->opportunity_id = $uuid;
            $thread->user_id = Auth::user()->id;
            $thread->save();

            return response(200);
        }
        return abort(404);
    }

    public function postNewThreadMessage($uuid, Request $request)
    {
        if(Auth::user()->hasOpportunity($uuid)){
            Validator::make($request->all(), [
                'message' => 'required|string',
                'thread' => 'required|string'
            ])->validate();
            
            $message = new OpportunityThreadMessage();
            $message->message = $request->get('message');
            $message->opportunity_thread_id = $request->get('thread');
            $message->user_id = Auth::user()->id;
            $message->save();

            foreach($message->opportunity_thread->opportunity->assignees as $assignee){
                Mail::to($assignee->user->email)
                    ->queue(new PartnerSentThreadMessage($message, $assignee->user));
            }

            
            return response(200);
        }
        return abort(404);
    }
    
    public function showMagicLink($uuid)
    {
        $endUsers = Auth::user()->endUsers;
        $endUsersSelect = [];
        foreach($endUsers as $endUser){
            $endUsersSelect[$endUser->id] = "$endUser->name ($endUser->contact_name)";
        }

        return view('partner.opportunities.create', [
            'endUsers' => $endUsersSelect,
            'magic_link' =>  true,
            'vendor' => Organisation::find($uuid),
            'vendors' => [],
            'vendors_json' => [],
        ]);
    }
    
    public function showCreateOpportunity()
    {
        $endUsers = Auth::user()->endUsers;
        $endUsersSelect = [];
        foreach($endUsers as $endUser){
            $endUsersSelect[$endUser->id] = "$endUser->name ($endUser->contact_name)";
        }

        $vendors = Organisation::orderBy('name','ASC')->get();
        $vendorsSelect = [];
        $vendorsJson = [];
        foreach($vendors as $vendor){
            $vendorsSelect[$vendor->id] = $vendor->name;
            $vendorsJson[] = [
                'id' => $vendor->id,
                'name' => $vendor->name
            ];
        }

        return view('partner.opportunities.create', [
            'endUsers' => $endUsersSelect,
            'vendors' =>  $vendorsSelect,
            'vendors_json' => $vendorsJson,
            'magic_link' =>  false,
        ]);
    }
    
    public function postCreateOpportunity(Request $request)
    {
        $rules = [
            'vendor' => 'required|string|max:255',
            'end_user' => 'required|string|max:255',
            'opportunity_name' => 'required|string|max:255',
            'opportunity_reference' => 'max:64',
            'date_of_award' => 'max:64',
            'implementation_date' => 'required|string|max:64',
            'estimated_value' => 'required|string|max:32',
            'estimated_units' => 'max:32',
            'purchase_type' => 'required|string|max:255',
            'procurement_type' => 'required|string|max:255',
            'direct_indirect_procurement' => 'required|string|max:255',
            'competitors' => 'max:255',
            'justification' => 'required|string|min:128',
            'products' => 'required|array',
        ];

        foreach($request->get('products') as $key => $val)
        {
            $rules['products.'.$key.'.name'] = 'required|max:255';
            $rules['products.'.$key.'.description'] = 'required|max:255';
        }

        Validator::make($request->all(), $rules)->validate();


        $opportunity = new Opportunity();
        $opportunity->id = Uuid::generate();
        $opportunity->name = $request->input('opportunity_name');
        $opportunity->user_id = Auth::user()->id;
        $opportunity->organisation_id = $request->input('vendor');
        $opportunity->deal_id = null;
        $opportunity->end_user_id = $request->input('end_user');
        $opportunity->reference = $request->input('opportunity_reference');
        if($request->input('date_of_award')) {
            $opportunity->date_of_award = Carbon::createFromFormat('d/m/Y', $request->input('date_of_award'))->toDateTimeString();
        }
        if($request->input('implementation_date')){
            $opportunity->implementation_date = Carbon::createFromFormat('d/m/Y',$request->input('implementation_date'))->toDateTimeString();
        }
        $opportunity->estimated_value = (int) preg_replace('|[^0-9]|i', '', $request->input('estimated_value')) * 100;
        $opportunity->estimated_units = $request->input('estimated_units');
        $opportunity->purchase_type = $request->input('purchase_type');
        $opportunity->procurement_type = $request->input('procurement_type');
        $opportunity->direct_indirect_procurement = $request->input('direct_indirect_procurement');
        $opportunity->competitors = $request->input('competitors');
        $opportunity->justification = $request->input('justification');
        $opportunity->save();

        event(new CreateOpportunityActivity(
            $opportunity,
            Auth::user(),
            $opportunity->name.' created by '.Auth::user()->first_name.' '.Auth::user()->last_name.'.',
            '/vendor/opportunities/'.$opportunity->id
        ));

        OpportunityStatus::create([
            'id' => Uuid::generate(),
            'opportunity_id' => $opportunity->id,
            'associated' => false,
            'in_review' => false,
            'accepted' => null,
        ]);
        
        foreach($opportunity->getDefaultConsiderations() as $consideration){
            OpportunityConsideration::create([
                'id' => Uuid::generate(),
                'opportunity_id' => $opportunity->id,
                'user_id' => Auth::user()->id,
                'title' => $consideration,
                'achieved' => false
            ]);
        }

        event(new CreateOpportunityActivity(
            $opportunity,
            Auth::user(),
            'Considerations were generated for '.$opportunity->name.'.'
        ));

        foreach($request->get('products') as $key => $product)
        {
            OpportunityProduct::create([
                'id' => Uuid::generate(),
                'opportunity_id' => $opportunity->id,
                'name' => $product['name'],
                'description' => $product['description']
            ]);

            event(new CreateOpportunityActivity(
                $opportunity,
                Auth::user(),
                $product['name'].' was added to '.$opportunity->name.'.'
            ));
        }


        return redirect('/partner/opportunities/'.$opportunity->id);
    }

}