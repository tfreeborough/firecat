<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/06/2017
 * Time: 11:32
 */

namespace App\Http\Controllers\Partner;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\EndUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class EndUserController extends Controller
{

    public function showEndUsers()
    {
        return view('partner.endUsers.index', [
            'endUsers' => Auth::user()->endUsers
        ]);
    }

    public function showCreateEndUser()
    {
        return view('partner.endUsers.create', [

        ]);
    }

    public function postCreateEndUser(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'organisation_type' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'max:255',
            'city' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postcode' => 'required|string|max:32',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:32',
            'contact_email' => 'required|string|max:255',
            'contact_job_title' => 'max:255',
            'parent_organisation' => 'max:255',
        ])->validate();
        
        $country = Helper::getCountryName($request->input('country'));

        EndUser::create([
            'id' => Uuid::generate(),
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'organisation_type' => $request->input('organisation_type'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'county' => $request->input('county'),
            'country' => $country,
            'postcode' => $request->input('postcode'),
            'contact_name' => $request->input('contact_name'),
            'contact_number' => $request->input('contact_number'),
            'contact_email' => $request->input('contact_email'),
            'contact_job_title' => $request->input('contact_job_title'),
            'parent_organisation' => $request->input('parent_organisation')
        ]);

        return redirect('/partner/end-users');
    }

}