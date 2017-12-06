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
        return view('partner.dashboard');
    }
}