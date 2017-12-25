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

class DealStatus extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'pending',
        'won',
        'deal_id',
        'created_at',
        'updated_at'
    ];
    
    public function deal()
    {
        return $this->belongsTo('App\Models\Deal');
    }
}