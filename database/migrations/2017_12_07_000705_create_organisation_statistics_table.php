<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_statistics', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('organisation_id');
            $table->float('deal_conversion_rate');
            $table->integer('opportunities_received');
            $table->integer('opportunities_converted');
            $table->integer('average_deal_value');
            $table->integer('average_assignment_wait');
            $table->timestamp('calculated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_statistics');
    }
}
