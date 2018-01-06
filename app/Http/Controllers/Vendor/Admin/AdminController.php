<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 29/11/2017
 * Time: 15:16
 */

namespace App\Http\Controllers\Vendor\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    
    public function showAdmin()
    {
        $deals = Auth::user()->organisation->deals;
        $deals_won = 0;
        $deals_lost = 0;
        foreach ($deals as $deal){
            if($deal->status->won){
                $deals_won++;
            }elseif(!$deal->status->pending && !$deal->status->won){
                $deals_lost++;
            }
        }

        return view('vendor.admin.index')->with([
            'vendor' => Auth::user()->organisation,
            'deals_won' => $deals_won,
            'deals_lost' => $deals_lost
        ]);
    }
}