<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 20:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'second_email',
        'work_number',
        'mobile_number',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}