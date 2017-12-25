<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_updates', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('deal_id');
            $table->uuid('user_id');
            $table->string('type');
            $table->string('type_formatted');
            $table->string('proposal');
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
        Schema::dropIfExists('deal_updates');
    }
}
