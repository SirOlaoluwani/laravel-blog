<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_event', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('name', 225);
            $table->string('description', 225);
            $table->string('date', 225);
            $table->string('location', 225);
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
        Schema::dropIfExists('client_event');
    }
}