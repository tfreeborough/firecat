<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 29/11/2017
 * Time: 15:16
 */

namespace App\Http\Controllers\Vendor\Admin;


use App\Http\Controllers\Controller;
use App\Mail\InviteUser;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class OnboardingController extends Controller
{



    /**
     * @return $this
     */
    public function showOnboarding()
    {
        return view('vendor.admin.onboarding.onboarding')->with([
            'vendor' => Auth::user()->organisation,
            'invites' => Auth::user()->organisation->invites
        ]);
    }



    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function postInvite(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ])->validate();

        $invite = Invite::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'admin' => false,
            'vendor' => true,
            'partner' => false,
            'organisation_id' => Auth::user()->organisation->id,
            'organisation_admin' => !is_null($request['admin']),
            'token' => Uuid::generate(),
            'expiry' => Carbon::now()->addDays(7)
        ]);

        Mail::to($request['email'])->send(new InviteUser($invite));

        return redirect(route('vendor.admin.onboarding'))->with([
            'alert-success' => 'That user has been successfully invited to the system.'
        ]);
    }



    /**
     * @param $invite_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function deleteInvite($invite_id)
    {
        $invite = Invite::find($invite_id);
        if($invite && $invite->organisation->id === Auth::user()->organisation->id){
            $invite->delete();
            return redirect(route('vendor.admin.onboarding'))->with([
                'alert-success' => 'That invite has been successfully deleted.'
            ]);
        }
    }



    /**
     * @param $invite_id
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function renewInvite($invite_id)
    {
        $invite = Invite::find($invite_id);
        if($invite && $invite->organisation->id === Auth::user()->organisation->id){
            $invite->token = Uuid::generate();
            $invite->expiry = Carbon::now()->addDays(7);
            $invite->save();

            Mail::to($invite->email)->send(new InviteUser($invite));

            return redirect(route('vendor.admin.onboarding'))->with([
                'alert-success' => 'That invite has been successfully renewed and a new email sent to '.$invite->email.'.'
            ]);
        }
    }
}