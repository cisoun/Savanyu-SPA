<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiographySection extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function events()
    {
        return $this->hasMany('App\BiographyEvent');
    }

    public function section()
    {
        return $this->belongsTo('App\BiographySection');
    }
}
