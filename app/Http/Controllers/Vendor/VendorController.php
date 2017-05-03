<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;

class VendorController extends Controller
{

    public function showHome()
    {
        return view('vendor.home');
    }
    
}