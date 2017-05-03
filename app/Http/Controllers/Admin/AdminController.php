<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 23:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function showDashboard()
    {
        return view('vendor.dashboard');
    }
    
}