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

class OrganisationStatistic extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organisation_id',
        'deal_conversion_rate',
        'opportunities_received',
        'opportunities_converted',
        'average_deal_value',
        'average_assignment_wait',
        'calculated_at',
        'created_at',
        'updated_at'
    ];

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

}