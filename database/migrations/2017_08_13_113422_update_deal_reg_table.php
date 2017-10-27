<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDealRegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('organisation_id');
            $table->dropColumn('deal_information_id');
            $table->dropColumn('name');
            $table->string('reference')->nullable();
            $table->uuid('opportunity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('organisation_id');
            $table->uuid('deal_information_id');
            $table->string('name');
            $table->dropColumn('opportunity_id');
            $table->dropColumn('reference');
        });
    }
}
