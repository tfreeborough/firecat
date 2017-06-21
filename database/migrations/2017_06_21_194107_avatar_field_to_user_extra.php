<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AvatarFieldToUserExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            $table->string('avatar_id')->nullable();
            $table->string('avatar_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            $table->dropColumn('avatar_id');
            $table->dropColumn('avatar_url');
        });
    }
}
