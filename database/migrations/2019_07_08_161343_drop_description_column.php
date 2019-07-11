<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Transfert 'description' to 'text'.
        DB::update("update artworks set text = description where text is null;");

        // Disable foreign key constraints so we don't lose uploads.
        Schema::disableForeignKeyConstraints();

        // Remove column.
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        // Restore foreign key constraints.
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->string('description')->nullable();
        });
    }
}
