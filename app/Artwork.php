<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'name',
        'description',
        'text',
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
     * Get the uploads for the artwork.
     */
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }

    /**
     * Get the category that owns the artwork.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
