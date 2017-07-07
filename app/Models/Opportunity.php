<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 10:39
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'organisation_id',
        'end_user_id',
        'deal_id',
        'reference',
        'date_of_award',
        'implementation_date',
        'estimated_value',
        'estimated_units',
        'purchase_type',
        'procurement_type',
        'direct_indirect_procurement',
        'competitors',
        'justification',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function products()
    {
        return $this->hasMany('App\Models\OpportunityProduct');
    }
    
    public function deal()
    {
        return $this->belongsTo('App\Models\Deal');
    }
    
    public function endUser()
    {
        return $this->belongsTo('App\Models\EndUser');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation', 'organisation_id');
    }

    public function status()
    {
        return $this->hasOne('App\Models\OpportunityStatus', '');
    }

    public function assignees()
    {
        return $this->hasMany('App\Models\Assignee');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\OpportunityMessage');
    }

    public function getRecentMessages()
    {
        return OpportunityMessage::where('opportunity_id','=',$this->id)->orderBy('created_at','DESC')->limit(5)->get()->reverse();
    }

    public function getAllMessages()
    {
        return OpportunityMessage::where('opportunity_id','=',$this->id)->orderBy('created_at','DESC')->get()->reverse();
    }

    public function getParticipants()
    {
        $participants = [];
        foreach($this->messages as $message){
            if(!array_key_exists($message->user_id,$participants)){
                $participants[$message->user_id] = $message;
            }
        }
        return $participants;
    }
    
    public function activity()
    {
        return $this->hasMany('App\Models\OpportunityActivity');
    }
    
    public function getRecentActivity()
    {
        return OpportunityActivity::where('opportunity_id', '=', $this->id)->orderBy('created_at', 'DESC')->limit(5)->get()->reverse();
    }
}