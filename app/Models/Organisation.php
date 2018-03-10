<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/05/2017
 * Time: 22:24
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
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
        'name'
        ];
    
    public function memberCount()
    {
        return count($this->members);
    }

    public function members()
    {
        return $this->hasMany('App\Models\User');
    }
    
    public function invites()
    {
        return $this->hasMany('App\Models\Invite');
    }

    public function administrators()
    {
        return $this->hasMany('App\Models\OrganisationAdministrator');
    }

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
    }

    public function statistics()
    {
        return $this->hasMany('App\Models\OrganisationStatistic');
    }

    public function mostRecentStatistics()
    {
        return $this->statistics()->orderBy('created_at','DESC')->first();
    }

    public function hasOpportunity($id)
    {
        $opportunity = Opportunity::find($id);

        if(!is_null($opportunity)){
            return $opportunity->organisation->id === $this->id;
        }

        return false;
    }

    public function defaultConsiderations()
    {
        return [
            'Has the partner been contacted to acknowledge this opportunity?',
            'Has the partner brought a new opportunity or is introducing us to a new customer?',
            'Are all specifications of this opportunity able to be fulfilled?'
        ];
    }

    public function deals()
    {
        return $this->hasManyThrough('App\Models\Deal', 'App\Models\Opportunity');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\OrganisationTag');
    }

}