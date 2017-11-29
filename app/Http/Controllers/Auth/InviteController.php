<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\OrganisationAdministrator;
use App\Models\User;
use App\Models\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use GuzzleHttp\Client;
use Webpatser\Uuid\Uuid;

class InviteController extends Controller
{


    public function showInvite($uuid)
    {
        $invite = Invite::where('token','=',$uuid)->first();
        if($invite && $invite->withinExpiry()){
            return view('auth.invite')->with([
                'invite' => $invite
            ]);
        }else{
            if($invite){
                $invite->delete();
            }
            return view('auth.invite_error')->withErrors([
                'alert-danger' => 'Your invite has expired, please contact whoever invited you to request another invite to the system.'
            ]);
        }
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'required'
        ]);
    }

    public function verifyCaptcha($request)
    {
        $client = new Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $request->get('g-recaptcha-response')
            ]
        ]);
        $json = json_decode($res->getBody()->getContents());
        if($json->success){
            return true;
        }else{
            return false;
        }
    }

    public function buildUser($request, $uuid)
    {
        $invite = Invite::where('token','=',$uuid)->first();
        if($invite){
            $user = new User();
            $user->id = Uuid::generate();
            $user->first_name = $invite->first_name;
            $user->last_name = $invite->last_name;
            $user->email = $invite->email;
            $user->password = bcrypt($request->get('password'));
            $user->admin = false;
            $user->vendor = !is_null($invite->organisation);
            $user->partner = !$user->vendor;
            $user->email_verified = true;
            $user->email_verification_code = null;
            $user->email_verification_sent = $invite->created_at;
            $user->organisation_id = $invite->organisation_id;
            $user->save();


            UserExtra::create([
                'id' => Uuid::generate(),
                'user_id' => $user->id,
            ]);

            if($invite->organisation_admin){
                OrganisationAdministrator::create([
                    'id' => Uuid::generate(),
                    'organisation_id' => $invite->organisation_id,
                    'user_id' => $user->id
                ]);
            }

            $invite->delete();

            return $user;

        }else{
            return view('auth.invite_error')->withErrors([
                'alert-danger' => 'Your invite has expired, please contact whoever invited you to request another invite to the system.'
            ]);
        }
    }

    public function verifyInvite(Request $request, $uuid)
    {
        $this->validator($request->all())->validate();
        if($this->verifyCaptcha($request)){
            if($user = $this->buildUser($request, $uuid)){
                Auth::login($user);
                return redirect(route('dashboard'))->with([
                    'alert-success' => 'You have successfully created your account, enjoy!'
                ]);
            }else{
                return view('auth.invite_error')->withErrors([
                    'alert-danger' => 'Your invite has expired, please contact whoever invited you to request another invite to the system.'
                ]);
            }
        }else{
            return redirect(route('invite', $uuid))->withErrors([
                'alert-error' => 'We could not verify that you aren\'t a robot, you haven\'t augmented yourself recently have you?'
            ]);
        }
    }

}