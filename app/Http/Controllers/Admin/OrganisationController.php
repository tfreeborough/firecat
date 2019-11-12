<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/05/2017
 * Time: 17:25
 */

namespace App\Http\Controllers\Admin;


use App\Mail\InviteUser;
use App\Models\Invite;
use App\Models\Organisation;
use App\Models\OrganisationAdministrator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        ])->validate();

        $invite = Invite::create([
            'id' => Uuid::generate(),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'admin' => false,
            'vendor' => true,
            'partner' => false,
            'organisation_id' => $uuid,
            'organisation_admin' => !is_null($request['admin']),
            'token' => Uuid::generate(),
            'expiry' => Carbon::now()->addDays(7)
        ]);

        Mail::to($request['email'])->send(new InviteUser($invite));

        return redirect('/admin/onboarding/' . $uuid)->with([
            'alert-success' => 'That user has been successfully invited to the system.'
        ]);
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

        $user->vendor = true;
        $user->partner = false;
        $user->save();

        return redirect('/admin/onboarding/' . $uuid)->with([
            'alert-success' => 'That user has been successfully linked.'
        ]);;
    }



    /**
     * @param $uuid
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unlinkUser($uuid, $user)
    {
        $user = User::find($user);
        OrganisationAdministrator::where('organisation_id',$user->organisation->id)->where('user_id',$user->id)->delete();
        $user->organisation()->dissociate()->save();
        $user->vendor = false;
        $user->partner = false;
        $user->save();
        $user->delete();
        return redirect('/admin/onboarding/' . $uuid)->with([
            'alert-success' => 'That user has been successfully unlinked.'
        ]);
    }



    /**
     * @param $uuid
     * @param $user_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function adminifyUser($uuid, $user_id)
    {
        $user = User::find($user_id);
        if(!$user->isVendorAdministrator($uuid)){
            $admin = new OrganisationAdministrator();
            $admin->organisation_id = $uuid;
            $admin->user_id = $user->id;
            $admin->save();
            return redirect('/admin/onboarding/' . $uuid)->with([
                'alert-success' => 'That user has been successfully made an admin'
            ]);
        }
        return redirect('/admin/onboarding/' . $uuid)->withErrors([
            'alert-danger' => 'That user is already an admin of this organisation.'
        ]);
    }



    /**
     * @param $uuid
     * @param $user_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function deadminifyUser($uuid, $user_id)
    {
        $user = User::find($user_id);
        if($user->isVendorAdministrator($uuid)){
            $admin = OrganisationAdministrator::find($user->administration_roles()->where('organisation_id',$uuid)->first());
            $admin->delete();
            return redirect('/admin/onboarding/' . $uuid)->with([
                'alert-success' => 'That user has been successfully made a regular user'
            ]);
        }
        return redirect('/admin/onboarding/' . $uuid)->withErrors([
            'alert-danger' => 'That user is already a regular user'
        ]);
    }



    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInvites($uuid)
    {
        return view('admin.organisation.onboarding.invites', [
            'organisation' => Organisation::find($uuid)
        ]);
    }



    /**
     * @param $uuid
     * @param $invite_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function deleteInvite($uuid, $invite_id)
    {
        $invite = Invite::find($invite_id);
        if($invite && $invite->organisation->id === $uuid){
            $invite->delete();
            return redirect(route('admin.onboarding.index', $uuid))->with([
                'alert-success' => 'That invite has been successfully deleted.'
            ]);
        }
        return redirect(route('admin.onboarding.index', $uuid))->withErrors([
            'alert-danger' => 'This invite does not exist.'
        ]);
    }



    /**
     * @param $uuid
     * @param $invite_id
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function renewInvite($uuid, $invite_id)
    {
        $invite = Invite::find($invite_id);
        if($invite && $invite->organisation->id === $uuid){
            $invite->token = Uuid::generate();
            $invite->expiry = Carbon::now()->addDays(7);
            $invite->save();

            Mail::to($invite->email)->send(new InviteUser($invite));

            return redirect(route('admin.onboarding.index', $uuid))->with([
                'alert-success' => 'That invite has been successfully renewed and a new email sent to '.$invite->email.'.'
            ]);
        }
        return redirect(route('admin.onboarding.index', $uuid))->withErrors([
            'alert-danger' => 'This invite does not exist.'
        ]);
    }
}