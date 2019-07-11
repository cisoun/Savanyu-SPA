<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Upload;
use Intervention\Image\Facades\Image;

class UpdateUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Create folder for thumbnails.
        Storage::makeDirectory(public_path() . '/storage/min');

        # Update old records.
        DB::update("update uploads set path = substr(path, 8) where path like 'public/%';");

        # Generate thumbnail for each upload.
        $uploads = Upload::all();
        foreach ($uploads as $upload) {
            $source = public_path() . $upload->url;
            $target = public_path() . $upload->thumbnail_url;
            Image::make($source)->fit(50, 50)->save($target);
        }
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
