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
        'id',
        'artwork_id',
        //'type',
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
    protected $appends = ['url'];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getURLAttribute($value)
    {
        return Storage::url($this->path);
    }

    /**
     * Get the artwork that owns the upload.
     */
    public function artwork()
    {
        return $this->belongsTo('App\Artwork');
    }
}
