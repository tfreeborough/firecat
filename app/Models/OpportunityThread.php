<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/10/2017
 * Time: 23:42
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityThread extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'opportunity_id',
        'subject',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\OpportunityThreadMessage')->orderBy('created_at','DESC');
    }

    public function mostRecentMessage()
    {
        return $this->hasMany('App\Models\OpportunityThreadMessage')->orderBy('created_at','DESC')->limit(1);
    }
}