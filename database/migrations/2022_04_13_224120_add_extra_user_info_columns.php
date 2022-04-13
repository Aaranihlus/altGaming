<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraUserInfoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

      Schema::table('users', function($table) {
        $table->string('title_id')->nullable();
        $table->string('badge_id')->nullable();
        $table->string('twitch_channel')->nullable();
        $table->string('youtube_channel')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
