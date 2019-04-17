<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiographyEvent extends Model
{
    protected $fillable = [
        'biography_section_id',
        'title',
        'date'
    ];

    protected $guarded = ['id'];
    public $timestamps = false;
}
