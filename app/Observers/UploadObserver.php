<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use App\Upload;

class UploadObserver
{
    /**
     * Handle the upload "created" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function created(Upload $upload)
    {
        //
    }

    /**
     * Handle the upload "updated" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function updated(Upload $upload)
    {
        //
    }

    /**
     * Handle the upload "deleted" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function deleted(Upload $upload)
    {
        //
    }

    /**
     * Handle the upload "deleting" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function deleting(Upload $upload)
    {
        Storage::delete('public/' . $upload->path);
        Storage::delete('public/min/' . $upload->path);
    }

    /**
     * Handle the upload "restored" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function restored(Upload $upload)
    {
        //
    }

    /**
     * Handle the upload "force deleted" event.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function forceDeleted(Upload $upload)
    {
        //
    }
}
