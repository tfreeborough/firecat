<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/07/2017
 * Time: 22:17
 */

namespace App\Events;


use App\Models\Opportunity;
use Illuminate\Queue\SerializesModels;

class CreateOpportunityActivity
{
    use SerializesModels;
    
    public $opportunity;
    public $description;
    public $link;
    public $user;

    
    public function __construct(Opportunity $opportunity, $user, $description, $link = null)
    {
        $this->opportunity = $opportunity;
        $this->description = $description;
        $this->link = $link;
        $this->user = $user;
    }
}