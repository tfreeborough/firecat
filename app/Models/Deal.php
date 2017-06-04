<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/05/2017
 * Time: 22:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];

    public function partner()
    {
        return $this->hasOne('App\Models\User');
    }

    public function organisation()
    {
        return $this->hasOne('App\Models\Organisation');
    }

    public function information()
    {
        return $this->hasOne('App\Models\DealInformation');
    }

    public function assigned()
    {
        return $this->hasMany('App\Models\Assigned');
    }

}