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

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        if (array_key_exists('url', $attributes))
        {
            $this->setUrl($attributes['url']);
        }
    }

    public function update(array $attributes = array(), array $options = array())
    {
        $this->fill($attributes);

        if (array_key_exists('url', $attributes))
        {
            $this->setUrl($attributes['url']);
        }

        return $this->save();
    }

    /**
     * Get the artwork that owns the upload.
     */
    public function artwork()
    {
        return $this->belongsTo('App\Artwork');
    }

    public function setUrl($url)
    {
        $regex = "/(youtu\.be\/|youtube\.com\/(watch\?(.*&)?v=|(embed|v)\/))([^\?&\"'>]+)/";
        $matches = [];

        preg_match_all($regex, $url, $matches);

        $this->url = $matches[5][0];
    }
}
