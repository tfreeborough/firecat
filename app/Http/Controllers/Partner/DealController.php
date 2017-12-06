<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Partner;


use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Support\Facades\Auth;

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

}