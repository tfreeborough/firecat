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
use App\Models\Opportunity;
use App\Models\OpportunityProduct;
use App\Models\OpportunityStatus;
use App\Models\Organisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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

    public function showCreateOpportunity()
    {
        $endUsers = Auth::user()->endUsers;
        $endUsersSelect = [];
        foreach($endUsers as $endUser){
            $endUsersSelect[$endUser->id] = "$endUser->name ($endUser->contact_name)";
        }

        $vendors = Organisation::orderBy('name','ASC')->get();
        $vendorsSelect = [
            '' => '-- Select a Vendor --'
        ];
        foreach($vendors as $vendor){
            $vendorsSelect[$vendor->id] = $vendor->name;
        }

        return view('partner.opportunities.create', [
            'endUsers' => $endUsersSelect,
            'vendors' =>  $vendorsSelect
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


        $uuid = Uuid::generate();

        Opportunity::create([
            'id' => $uuid,
            'name' => $request->input('opportunity_name'),
            'user_id' => Auth::user()->id,
            'organisation_id' => $request->input('vendor'),
            'deal_id' => null,
            'end_user_id' => $request->input('end_user'),
            'reference' => $request->input('opportunity_reference'),
            'date_of_award' => Carbon::createFromFormat('d/m/Y',$request->input('date_of_award'))->toDateTimeString(),
            'implementation_date' => Carbon::createFromFormat('d/m/Y',$request->input('implementation_date'))->toDateTimeString(),
            'estimated_value' => (int) preg_replace('|[^0-9]|i', '', $request->input('estimated_value')) * 100,
            'estimated_units' => $request->input('estimated_units'),
            'purchase_type' => $request->input('purchase_type'),
            'procurement_type' => $request->input('procurement_type'),
            'direct_indirect_procurement' => $request->input('direct_indirect_procurement'),
            'competitors' => $request->input('competitors'),
            'justification' => $request->input('justification')
        ]);

        $opportunity = Opportunity::find($uuid);
        event(new CreateOpportunityActivity(
            $opportunity,
            Auth::user(),
            'Opportunity created by '.Auth::user()->first_name.' '.Auth::user()->last_name.'.',
            '/vendor/opportunities/'.$opportunity->id
        ));

        OpportunityStatus::create([
            'id' => Uuid::generate(),
            'opportunity_id' => $uuid,
            'associated' => false,
            'in_review' => false,
            'accepted' => null
        ]);

        foreach($request->get('products') as $key => $product)
        {
            OpportunityProduct::create([
                'id' => Uuid::generate(),
                'opportunity_id' => $uuid,
                'name' => $product['name'],
                'description' => $product['description']
            ]);

            event(new CreateOpportunityActivity(
                $opportunity,
                Auth::user(),
                $product['name'].' was added to this opportunity.'
            ));
        }


        return redirect('/partner/opportunities/'.$uuid);
    }

}