<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiographyEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biography_events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('section_id');
            $table->string('title');
            $table->string('date');

            $table->foreign('section_id')
                  ->references('id')
                  ->on('biography_sections')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biography_events');
    }
}
