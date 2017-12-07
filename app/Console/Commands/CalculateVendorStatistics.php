<?php

namespace App\Console\Commands;

use App\Models\Organisation;
use App\Models\OrganisationStatistic;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateVendorStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:vendor_statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates all statistics for all vendors in the system.';

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
        $organisations = Organisation::all();
        foreach ($organisations as $organisation)
        {
            $organisation_statistic = new OrganisationStatistic();
            $organisation_statistic->organisation()->associate($organisation);

            $organisation_statistic->opportunities_received = count($organisation->opportunities()->where('created_at','>',Carbon::now()->subMonth(1))->get());
            $organisation_statistic->opportunities_converted = count($organisation->deals()->where('deals.created_at','>',Carbon::now()->subMonth(1))->get());

            $organisation_statistic->opportunities_received > 0
                ? $organisation_statistic->deal_conversion_rate = (100/$organisation_statistic->opportunities_received)*$organisation_statistic->opportunities_converted
                : $organisation_statistic->deal_conversion_rate = 0;


            $total_deal_value = 0;
            $total_deal_count = $organisation_statistic->opportunities_converted;

            foreach($organisation->deals()->where('deals.created_at','>',Carbon::now()->subMonth(1))->get() as $deal)
            {
                $total_deal_value += $deal->opportunity->estimated_value;
            }

            $total_deal_count > 0
                ? $organisation_statistic->average_deal_value = ($total_deal_value/$total_deal_count)
                : $organisation_statistic->average_deal_value = 0;

            $total_assignment_wait = 0;

            foreach($organisation->opportunities()->where('created_at','>',Carbon::now()->subMonth(1))->get() as $opportunity)
            {
                $first_assignment = $opportunity->assignees()->orderBy('created_at','ASC')->first();
                $opportunity_created = $opportunity->created_at;
                $assignment_diff = Carbon::parse($opportunity_created)->diffInSeconds($first_assignment->created_at);
                $total_assignment_wait += $assignment_diff;
            }

            $organisation_statistic->opportunities_received > 0
                ? $organisation_statistic->average_assignment_wait = $total_assignment_wait/$organisation_statistic->opportunities_received
                : $organisation_statistic->average_assignment_wait = 0;

            $organisation_statistic->calculated_at = Carbon::now();
            $organisation_statistic->save();
        }
    }
}
