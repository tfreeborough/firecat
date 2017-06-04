<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/05/2017
 * Time: 22:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
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
    
    public function memberCount()
    {
        return count($this->members);
    }

    public function members()
    {
        return $this->hasMany('App\Models\User');
    }

}