<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:43
 */

namespace App\Http\Controllers\Partner;


use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    
    
    
    public function showHome()
    {
        return view('partner.home');
    }
}