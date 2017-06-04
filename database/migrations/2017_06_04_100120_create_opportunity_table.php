<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('user_id');
            $table->uuid('organisation_id');
            $table->uuid('deal_id')->nullable();
            $table->uuid('end_user_id');
            $table->string('reference')->nullable();
            $table->dateTime('date_of_award')->nullable();
            $table->dateTime('implementation_date');
            $table->integer('estimated_value');
            $table->integer('estimated_units')->nullable();
            $table->string('purchase_type');
            $table->string('procurement_type');
            $table->string('direct_indirect_procurement');
            $table->string('competitors')->nullable();
            $table->text('justification');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunities');
    }
}
