<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/06/2017
 * Time: 23:17
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityMessage extends Model
{
    use SoftDeletes;
    
    public $incrementing = false;

    protected $fillable = [
        'id',
        'opportunity_id',
        'user_id',
        'message',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

    public function generateColorCode()
    {
        $code = dechex(crc32($this->user_id));
        $code = substr($code, 0, 6);
        return '#'.$code;
    }

    public function isUser($uuid)
    {
        return $this->user_id === $uuid;
    }
}