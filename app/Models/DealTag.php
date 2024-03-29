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

class DealTag extends Model
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
        'organisation_tag_id',
        'deal_id',
        'created_at',
        'updated_at'
    ];

    public function organisation_tag()
    {
        return $this->belongsTo('App\Models\OrganisationTag');
    }

    public function deal()
    {
        return $this->belongsTo('App\Models\Deal');
    }


}