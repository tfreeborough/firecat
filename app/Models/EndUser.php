<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/06/2017
 * Time: 10:54
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EndUser extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'organisation_type',
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'country',
        'postcode',
        'contact_name',
        'contact_number',
        'contact_email',
        'contact_job_title',
        'parent_organisation',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function partner()
    {
        return $this->hasOne('App\Models\User');
    }
}