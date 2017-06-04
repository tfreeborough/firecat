<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('user_id');
            $table->string('organisation_type');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('county');
            $table->string('country');
            $table->string('postcode');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->string('contact_job_title')->nullable();
            $table->string('parent_organisation')->nullable();
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
        Schema::dropIfExists('end_users');
    }
}
