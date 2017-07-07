<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/07/2017
 * Time: 22:18
 */

namespace App\Listeners;


use App\Models\Opportunity;
use App\Models\OpportunityActivity;
use Webpatser\Uuid\Uuid;

class CreateOpportunityActivityListener
{

    public function __construct()
    {
    }

    public function handle($event)
    {
        $activity = new OpportunityActivity();
        $activity->id = Uuid::generate();
        $activity->opportunity_id = $event->opportunity->id;
        $activity->user_id = $event->user->id;
        $activity->description = $event->description;
        $activity->link = $event->link;
        $activity->save();
    }

}