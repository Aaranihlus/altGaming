<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_banner', function (Blueprint $table) {
            $table->id();
            $table->string("order");
            $table->string("object_type")->nullable();
            $table->string("object_id")->nullable();
            $table->string("object_name")->nullable();
            $table->text("custom_text")->nullable();
            $table->string("custom_image")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hero_banner');
    }
}
