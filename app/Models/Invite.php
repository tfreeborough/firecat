<?php

namespace App\Models;


use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'admin',
        'vendor',
        'partner',
        'organisation_id',
        'organisation_admin',
        'token',
        'expiry',
        'created_at',
        'updated_at'
    ];

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

    public function withinExpiry()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->expiry)) < 7;
    }

}