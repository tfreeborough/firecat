<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 23:27
 */

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function directToDashboard()
    {
        if($this->user->isAdmin()){
            return redirect('/admin');
        }else if($this->user->isVendor()){
            return redirect('/vendor');
        }else if($this->user->isPartner()){
            return redirect('/partner');
        }else{
            return redirect('/logout');
        }
    }

    public function showAccount()
    {
        if($this->user->isAdmin()){
            return view('account.admin');
        }else if($this->user->isVendor()){
            return view('account.vendor');
        }else if($this->user->isPartner()){
            return view('account.partner');
        }else{
            return redirect('/logout');
        }
    }

}