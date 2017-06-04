<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 10:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OpportunityProduct extends Model
{

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