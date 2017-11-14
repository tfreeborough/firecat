<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Verify;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserExtra;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'id' => Uuid::generate()->string,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => false,
            'vendor' => false,
            'partner' => true,
            'email_verified' => false,
            'email_verification_code' => Uuid::generate(),
            'email_verification_sent' => Carbon::now()
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $client = new Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $request->get('g-recaptcha-response')
            ]
        ]);
        $json = json_decode($res->getBody()->getContents());
        if($json->success){
            event(new Registered($user = $this->create($request->all())));

            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        }else{
            return redirect(route('register'))->withErrors([
                'alert-error' => 'We could not verify that you aren\'t a robot, you haven\'t augmented yourself recently have you?'
            ]);
        }

    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Mail::to($user->email)->send(new Verify($user));
        UserExtra::create([
            'id' => Uuid::generate(),
            'user_id' => $user->id,
        ]);
    }
}
