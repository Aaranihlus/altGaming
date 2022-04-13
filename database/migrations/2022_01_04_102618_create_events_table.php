<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('location');
            $table->text('description');
            $table->string('type');
            $table->string('slug');
            $table->foreignId('user_id');
            $table->string('thumbnail');
            $table->string('achievement_id')->nullable();
            $table->boolean('active')->default(null);
            $table->string('alt_lan_number')->default(null);
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
        //
    }
}
