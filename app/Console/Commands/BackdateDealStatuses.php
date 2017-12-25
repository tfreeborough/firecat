<?php

namespace App\Console\Commands;

use App\Models\Deal;
use App\Models\DealStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BackdateDealStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backdate:deal_statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all deals and if a deal status is not found, creates one.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deals = Deal::all();
        foreach ($deals as $deal)
        {
            if(!$deal->status){
                $deal_status = new DealStatus();
                $deal_status->pending = true;
                $deal_status->won = false;
                $deal_status->deal_id = $deal->id;
                $deal_status->save();
            }
        }
    }
}
