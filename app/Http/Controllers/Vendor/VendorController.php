<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDashboard()
    {
        $organisation = Auth::user()->organisation;
        return view('vendor.dashboard', [
            'organisation' => $organisation,
            'statistics' => $organisation->mostRecentStatistics(),
            'assignments' => Auth::user()->assignments
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