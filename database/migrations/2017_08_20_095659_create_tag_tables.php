<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_tags', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('organisation_tag_id');
            $table->uuid('deal_id');
            $table->timestamps();
        });
        Schema::create('organisation_tags', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('color');
            $table->string('text_color');
            $table->uuid('organisation_id');
            $table->uuid('user_id');
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
        Schema::dropIfExists('deal_tags');
        Schema::dropIfExists('organisation_tags');
    }
}
