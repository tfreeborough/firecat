<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/05/2017
 * Time: 17:25
 */

namespace App\Http\Controllers\Admin;


use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

/**
 * Class OrganisationController
 * @package App\Http\Controllers\Admin
 */
class OrganisationController
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOnboarding()
    {
        return view('admin.organisation.onboarding', [
            'organisations' => Organisation::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOrganisationCreation()
    {
        return view('admin.organisation.create_organisation');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function postOrganisationCreation(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:organisations',
        ])->validate();

        $organisation = new Organisation();
        $organisation->id = Uuid::generate();
        $organisation->name = $request->input('name');
        $organisation->save();

        return redirect('/admin/onboarding');
    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOrganisation($uuid)
    {
        return view('admin.organisation.index', [
            'organisation' => Organisation::find($uuid)
        ]);
    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserAdd($uuid)
    {
        return view('admin.organisation.add', [
            'organisation' => Organisation::find($uuid),
            'json_users' => json_encode(User::all())
        ]);
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postUserAddNew(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ])->validate();

        User::create([
            'id' => Uuid::generate(),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'admin' => false,
            'vendor' => true,
            'partner' => false,
            'email_verified' => true,
            'organisation_id' => $uuid
        ]);

        return redirect('/admin/onboarding/' . $uuid);
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return $this
     */
    public function postUserAddLink(Request $request, $uuid)
    {
        Validator::make($request->all(), [
            'email' => 'required|string|email|max:255'
        ])->validate();

        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user->organisation_id) {
            return redirect('/admin/onboarding/' . $uuid . '/add')->withErrors([
                'This user already belongs to an organisation (' . $user->organisation->name . ')'
            ]);
        }

        Organisation::find($uuid)->members()->save($user);
        return redirect('/admin/onboarding/' . $uuid);
    }


    /**
     * @param $uuid
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unlinkUser($uuid, $user)
    {
        User::find($user)->organisation()->dissociate()->save();
        return redirect('/admin/onboarding/' . $uuid);
    }
}