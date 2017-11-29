<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/05/2017
 * Time: 22:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use SoftDeletes;

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

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity');
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
        return [];
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