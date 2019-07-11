<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artwork_id',
        'path',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $appends = ['url', 'thumbnail_url'];

    /**
     * Get the upload's thumbnail's URL.
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailURLAttribute()
    {
        return Storage::url('public/min/' . $this->path);
    }

    /**
     * Get the upload's URL.
     *
     * @param  string  $value
     * @return string
     */
    public function getURLAttribute()
    {
        return Storage::url('public/' . $this->path);
    }

    /**
     * Get the artwork that owns the upload.
     */
    public function artwork()
    {
        return $this->belongsTo('App\Artwork');
    }
}
