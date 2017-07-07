<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/07/2017
 * Time: 22:01
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpportunityActivity extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'opportunity_id',
        'user_id',
        'description',
        'link',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }
}