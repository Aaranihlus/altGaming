<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('profile_visible')->default(false);
            $table->string('twitch_channel')->nullable();
            $table->string('youtube_channel')->nullable();
            $table->string('discord_id')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('profile_picture_small')->nullable();
            $table->boolean('title_id')->default(false)->nullable();
            $table->boolean('badge_id')->default(false)->nullable();
            $table->string('real_name')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('address_line3')->nullable();
            $table->string('address_line4')->nullable();
            $table->string('postcode')->nullable();
            $table->string('exp')->default(0);
            $table->boolean('banned')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
