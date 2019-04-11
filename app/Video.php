<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'artwork_id',
        'url'
    ];

    protected $guarded = ['id'];

    public $timestamps = true;

    /**
     * Get the artwork that owns the upload.
     */
    public function artwork()
    {
        return $this->belongsTo('App\Artwork');
    }
}
