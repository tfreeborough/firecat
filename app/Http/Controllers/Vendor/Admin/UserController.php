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

class UserController extends Controller
{


    public function showUsers()
    {
        return view('vendor.admin.users.index')->with([
            'vendor' => Auth::user()->organisation,
            'users' => Auth::user()->organisation->members
        ]);
    }
}