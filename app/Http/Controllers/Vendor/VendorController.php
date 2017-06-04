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

    public function showDashboard()
    {
        $organisation = Auth::user()->organisation;
        return view('vendor.dashboard', [
            'acceptanceRate' => $organisation->getAcceptanceRate,
            'opportunitiesCreated' => $organisation->getOpportunitiesCreated,
            'averageDealValue' => $organisation->getAverageDealValue,
            'averageResponseTime' => $organisation->getResponseTime,
            'deals' => $organisation->deals === null ? [] : $organisation->deals
        ]);
    }

    public function showActivity()
    {
        return view('vendor.activity', [
            'organisation' => Auth::user()->organisation
        ]);
    }
    
    public function showDeals()
    {
        return view('vendor.deals', [
            'organisation' => Auth::user()->organisation,
            'deals' => Auth::user()->organisation->deals 
        ]);
    }

    public function showOpportunities()
    {
        return view('vendor.opportunities', [
            'organisation' => Auth::user()->organisation,
        ]);
    }
    
}