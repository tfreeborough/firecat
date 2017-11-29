<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/05/2017
 * Time: 02:11
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mail\InviteUser;
use App\Models\Invite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
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

    public function postPartnerInvite(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ])->validate();

        $invite = Invite::create([
            'id' => Uuid::generate(),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'admin' => false,
            'vendor' => false,
            'partner' => true,
            'organisation_id' => null,
            'organisation_admin' => false,
            'token' => Uuid::generate(),
            'expiry' => Carbon::now()->addDays(7)
        ]);

        Mail::to($request['email'])->send(new InviteUser($invite));

        return redirect(route('admin.partners.create'))->with([
            'alert-success' => 'That user has been successfully invited to the system.'
        ]);
    }

    public function showPartner($uuid)
    {
        return view('admin.partner.index', [
           'partner' => User::find($uuid)
        ]);
    }

    public function deletePartner($uuid)
    {
        $partner = User::find($uuid);
        if($partner->isPartner()){
            $partner->vendor = false;
            $partner->partner = false;
            $partner->admin = false;
            $partner->save();
            $partner->delete();
            return redirect(route('admin.partners'))->with([
                'alert-success' => 'Partner successfully deleted.'
            ]);
        }else{
            return redirect(route('admin.partners.index',$uuid))->withErrors([
                'alert-danger' => 'That user is not a partner'
            ]);
        }
    }
}