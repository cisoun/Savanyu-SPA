<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->integer('order')->nullable();

            // Unique order index for each artwork in its category.
            $table->unique(['order', 'category_id']);
        });

        // Add order index to every artwork.
        DB::update('UPDATE artworks
            SET `order` = ( SELECT COUNT(a.`order`)
            FROM artworks a
            WHERE a.category_id = artworks.category_id ) + 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
