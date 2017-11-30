<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 09/05/2017
 * Time: 22:13
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignee extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

}