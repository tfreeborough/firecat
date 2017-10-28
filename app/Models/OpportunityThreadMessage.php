<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/10/2017
 * Time: 23:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OpportunityThreadMessage extends Model
{
    use \App\Traits\Uuids;
    
    public $incrementing = false;

    protected $fillable = [
        'id',
        'thread_id',
        'message',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function thread()
    {
        return $this->belongsTo('App\Models\OpportunityThread');
    }
}