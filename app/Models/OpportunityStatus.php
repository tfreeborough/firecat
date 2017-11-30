<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 12:45
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpportunityStatus extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'opportunity_id',
        'associated',
        'in_review',
        'accepted',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

    public function getStatusCode()
    {
        $status = 0;
        if($this->associated){
            $status = 1;
            if($this->in_review){
                $status = 2;
                if(!is_null($this->accepted)){
                    if($this->accepted){
                        $status = 4;
                    }else{
                        $status = 5;
                    }
                }else{
                    $status = 3;
                }
            }
        }
        return $status;
    }
}