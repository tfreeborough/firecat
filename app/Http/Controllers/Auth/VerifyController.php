<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02/05/2017
 * Time: 23:41
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class VerifyController extends Controller
{


    public function showVerify()
    {
        return view('auth.verify');
    }

}