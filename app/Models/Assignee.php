<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 09/05/2017
 * Time: 22:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{

    public $incrementing = false;


    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function opportunity()
    {
        return $this->hasOne('App\Models\Opportunity');
    }

}