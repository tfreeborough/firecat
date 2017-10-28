<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/10/2017
 * Time: 23:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OpportunityThread extends Model
{
    use \App\Traits\Uuids;

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
        return $this->hasMany('App\Models\OpportunityThreadMessage');
    }
}