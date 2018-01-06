<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\OpportunityActivity;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDashboard()
    {
        $organisation = Auth::user()->organisation;
        $assignments = Auth::user()->assignments;

        $opportunity_array = [];
        foreach($assignments as $assignment){
            $opportunity_array[] = $assignment->opportunity_id;
        }
        $recent_activity = OpportunityActivity::whereIn('opportunity_id',$opportunity_array)->orderBy('created_at','DESC')->take(5)->get();

        return view('vendor.dashboard', [
            'organisation' => $organisation,
            'statistics' => $organisation->mostRecentStatistics(),
            'assignments' =>  $assignments,
            'recent_activity' => $recent_activity
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showActivity()
    {
        return view('vendor.activity', [
            'organisation' => Auth::user()->organisation
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDeals()
    {
        return view('vendor.deals.index', [
            'organisation' => Auth::user()->organisation,
            'deals' => Auth::user()->organisation->deals 
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOpportunities()
    {
        return view('vendor.opportunities.index', [
            'organisation' => Auth::user()->organisation,
        ]);
    }
    
}