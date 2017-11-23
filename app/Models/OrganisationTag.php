<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/05/2017
 * Time: 22:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrganisationTag extends Model
{
    use \App\Traits\Uuids;
    
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'organisation_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

    public function deal_tags()
    {
        return $this->hasMany('App\Models\DealTag');
    }

}