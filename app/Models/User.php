<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

class User extends Authenticatable
{
    use Notifiable;

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


    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

    public function deals()
    {
        return $this->hasMany('App\Models\Deal');
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
            if($assignee->user->id === Auth::user()->id){
                return true;
            }
        }
        return false;
    }

    public function getAvatar()
    {
        return ($this->extra->avatar_id ? Cloudder::show($this->extra->avatar_id) : '/images/avatar.png');
    }
}
