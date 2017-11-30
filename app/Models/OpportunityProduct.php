<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 10:44
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityProduct extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'opportunity_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

}