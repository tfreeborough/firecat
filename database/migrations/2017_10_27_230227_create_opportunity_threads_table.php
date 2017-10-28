<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunity_threads', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('opportunity_id');
            $table->string('subject');
            $table->uuid('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('opportunity_thread_messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('opportunity_thread_id');
            $table->text('message');
            $table->uuid('user_id');
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
        Schema::dropIfExists('opportunity_threads');
        Schema::dropIfExists('opportunity_thread_messages');
    }
}
