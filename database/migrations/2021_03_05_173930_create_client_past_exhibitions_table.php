<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPastExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_past_exhibitions', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('name', 225);
            $table->string('location', 225);
            $table->string('year', 225);
            $table->text('featured_image_url');
            $table->tinyInteger('is_published');
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
        Schema::dropIfExists('client_past_exhibitions');
    }
}