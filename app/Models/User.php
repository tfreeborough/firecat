<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'admin',
        'vendor',
        'partner',
        'email_verified',
        'email_verification_code',
        'email_verification_sent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

    public function deals()
    {
        return $this->hasManyThrough('App\Models\Deal', 'App\Models\Opportunity');
    }

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }

    public function assignments()
    {
        return $this->hasMany('App\Models\Assignee');
    }
    
    public function endUsers()
    {
        return $this->hasMany('App\Models\EndUser');
    }

    public function extra()
    {
        return $this->hasOne('App\Models\UserExtra');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\OpportunityMessage');
    }

    public function activity()
    {
        return $this->hasMany('App\Models\OpportunityActivity');
    }
    
    public function administration_roles()
    {
        return $this->hasMany('App\Models\OrganisationAdministrator');
    }
    
    public function isPartner()
    {
        return $this->partner;
    }

    public function isVendor()
    {
        return $this->vendor;
    }

    public function isAdmin()
    {
        return $this->admin;
    }
    
    public function isVerified()
    {
        return $this->email_verified;
    }
    
    public function hasOpportunity($id)
    {
        $opportunity = Opportunity::find($id);

        if(!is_null($opportunity)){
            return $opportunity->partner->id === $this->id;
        }
        
        return false;
    }

    public function isAssigned($id)
    {
        $opportunity = Opportunity::find($id);
        
        foreach($opportunity->assignees as $assignee){
            if($assignee->user->id === $this->id){
                return true;
            }
        }

        if($this->isVendorAdministrator($opportunity->organisation->id)){
            return true;
        }
        return false;
    }

    public function isVendorAdministrator($id)
    {
        $vendor = Organisation::find($id);
        foreach($vendor->administrators as $admin){
            if($admin->user !== null && $admin->user->id === $this->id){
                return true;
            }
        }
        return false;
    }

    public function getAvatar()
    {
        return ($this->extra->avatar_id ? Cloudder::secureShow($this->extra->avatar_id, [
            'width' => 128,
            'height' => 128,
            'crop' => 'fill',
            'gravity' => 'face'
        ]) : '/images/avatar.png');
    }


}
