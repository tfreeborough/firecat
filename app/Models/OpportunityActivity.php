<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/07/2017
 * Time: 22:01
 */

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityActivity extends Model
{
    use SoftDeletes;
    use Uuids;

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