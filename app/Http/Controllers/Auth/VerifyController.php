<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02/05/2017
 * Time: 23:41
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Mail\Verify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{

    private $loginController;

    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    public function showVerify()
    {
        return view('auth.verify');
    }

    public function showResend()
    {
        return view('auth.verify')->withErrors([
            'Please fill out the form to request a new code.'
        ]);
    }

    /**
     * @param $token
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = User::where([
            ['email_verification_code','=',$token],
            ['email_verification_sent','>=',Carbon::now()->subDay(1)]
        ])->first();

        if($user){
            $user->email_verification_code = null;
            $user->email_verified = true;
            $user->save();
            Auth::login($user);
            if($user->isAdmin()){
                return redirect('/admin');
            }else if($user->isVendor()){
                return redirect('/vendor')->with([
                    'alert-success' => 'You have been successfully verified, welcome to your new account.'
                ]);
            }else if($user->isPartner()){
                return redirect('/partner')->with([
                    'alert-success' => 'You have been successfully verified, welcome to your new account.'
                ]);
            }else{
                return redirect('/logout');
            }
        }
        return redirect('verify')->withErrors([
            'Your token appears to be expired, please request another with the form on this page.'
        ]);
    }

    public function resend(Request $request)
    {
        if(Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ])){
            $user = User::where('email','=', $request->email)->first();
            if($user){
                $user->email_verification_code = Uuid::generate();
                $user->email_verification_sent = Carbon::now();
                $user->save();
                Mail::to($user->email)->send(new Verify($user));
            }
        }

        $request->session()->flash('status', 'Another code was sent to your email, please complete your account verification.');
        return redirect('verify');
    }

}