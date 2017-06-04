<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/05/2017
 * Time: 02:11
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class PartnerController extends Controller
{

    
    public function showPartners()
    {
        return view('admin.partner.partners', [
            'partners' => User::where('partner','=',true)->get()
        ]);
    }

    public function showPartnerCreation()
    {
        return view('admin.partner.create');
    }
    
    public function postPartnerCreation(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ])->validate();

        User::create([
            'id' => Uuid::generate(),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'admin' => false,
            'vendor' => false,
            'partner' => true,
            'email_verified' => true,
        ]);

        return redirect('admin.partner');
    }

    public function showPartner($uuid)
    {
        return view('admin.partner.index', [
           'partner' => User::find($uuid)
        ]);
    }
}