<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/12/2017
 * Time: 09:55
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class DealUpdate extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'deal_id',
        'user_id',
        'type',
        'type_formatted',
        'proposal',
        'created_at',
        'updated_at'
    ];

    public function deal()
    {
        return $this->belongsTo('App\Models\Deal');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isValid()
    {
        return in_array($this->type,[
            'implementation_date',
            'date_of_award'
        ], true);
    }

    public function isTime()
    {
        return in_array($this->type,[
            'implementation_date',
            'date_of_award'
        ], true);
    }
}