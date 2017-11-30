<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/10/2017
 * Time: 23:42
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityThreadMessage extends Model
{
    use SoftDeletes;
    use Uuids;
    
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