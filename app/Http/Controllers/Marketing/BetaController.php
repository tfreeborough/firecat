<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 30/11/2017
 * Time: 01:19
 */

namespace App\Http\Controllers\Marketing;


use App\Http\Controllers\Controller;
use App\Mail\BetaInterestSignup;
use App\Models\BetaInterest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BetaController extends Controller
{

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

    public function postInterestSubmission(Request $request)
    {
        Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255',
            'account_managers' => 'required',
            'g-recaptcha-response' => 'required'
        ])->validate();

        if($this->verifyCaptcha($request)){
            $interest = new BetaInterest();
            $interest->company_name = $request->get('company_name');
            $interest->contact_name = $request->get('contact_name');
            $interest->contact_email = $request->get('contact_email');
            $interest->account_managers = $request->get('account_managers');
            $interest->save();

            Mail::to(env('ADMIN_EMAIL'))->send(new BetaInterestSignup($interest));
            
            return redirect(route('home'))->with([
                'alert-success' => 'Thank you for registering your interest, we will be in touch with you soon to discuss options.'
            ]);
        }
        return redirect(route('home'))->withErrors([
            'alert-danger' => 'We are having some trouble registering your interest at the moment, please email support@firecat.io'
        ]);
    }

}