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
        'reference',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }
    
    public function tags()
    {
        return $this->hasMany('App\Models\DealTag');
    }


}