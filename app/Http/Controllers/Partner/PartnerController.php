<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:43
 */

namespace App\Http\Controllers\Partner;


use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    
    
    
    public function showDashboard()
    {
        $deals = Auth::user()->deals;
        $deals_won = 0;
        $deals_lost = 0;
        foreach ($deals as $deal){
            if($deal->status->won){
                $deals_won++;
            }elseif(!$deal->status->pending && !$deal->status->won){
                $deals_lost++;
            }
        }

        return view('partner.dashboard')->with([
            'deals' => $deals,
            'opportunities' => Auth::user()->opportunities,
            'deals_won' => $deals_won,
            'deals_lost' => $deals_lost,
            'win_rate' => (100/count($deals))*$deals_won
        ]);
    }
}