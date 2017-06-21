<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 23:27
 */

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder;
use Mockery\CountValidator\Exception;

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
            return view('account.admin',[
                'user' => $this->user,
            ]);
        }else if($this->user->isVendor()){
            return view('account.vendor', [
                'user' => $this->user,
            ]);
        }else if($this->user->isPartner()){
            return view('account.partner', [
                'user' => $this->user,
            ]);
        }else{
            return redirect('/logout');
        }
    }

    public function redirectAccount()
    {
        if($this->user->isAdmin()){
            return redirect('/admin/account');
        }else if($this->user->isVendor()){
            return redirect('/vendor/account');
        }else if($this->user->isPartner()){
            return redirect('/partner/account');
        }else{
            return redirect('/logout');
        }
    }

    public function postAvatar(Request $request)
    {
        Validator::make($request->all(), [
            'avatar' => 'required|image',
        ])->validate();

        $user = User::find(Auth::user()->id);

        if($user->extra->avatar_id){
            Cloudder::delete($user->extra->avatar_id);
            $user->extra->avatar_url = null;
            $user->extra->avatar_id = null;
        }

        $file = $request->file('avatar');
        $result = Cloudder::upload($file->getRealPath());

        $user->extra->avatar_id = $result->getPublicId();
        $user->extra->avatar_url = $result->secureShow($result->getPublicId());
        $user->extra->save();

        return $this->redirectAccount();
    }

    public function postAdditional(Request $request)
    {
        $user = User::find(Auth::user()->id);

        try{
            if($request->has('secondary_email')){
                Validator::make([$request->get('secondary_email')], ['secondary_email' => 'email|max:255'])->validate();
                if($request->get('secondary_email') === $user->email){
                    throw new Exception('You cannot have a secondary email the same as your primary email');
                }
                $user->extra->second_email = $request->get('secondary_email');
            }

            if($request->has('work_phone')){
                Validator::make([$request->get('work_phone')], ['work_phone' => 'string|max:255'])->validate();
                $user->extra->work_number = $request->get('work_phone');
            }

            if($request->has('mobile_phone')){
                Validator::make([$request->get('mobile_phone')], ['mobile_phone' => 'string|max:255'])->validate();
                if($request->get('mobile_phone') === $request->get('work_phone')){
                    throw new Exception('Your mobile number cannot be the same as your work number');
                }
                $user->extra->mobile_number = $request->get('mobile_phone');
            }

            $user->extra->save();
            return $this->redirectAccount();
        }catch(Exception $e){
            return $this->redirectAccount()->withErrors([
                $e->getMessage()
            ]);
        }
    }

}