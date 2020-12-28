<?php

namespace App\Model;

use Atriatech\Media\AtriatechMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    // use plugins here
    use AtriatechMedia, SoftDeletes;


    // Config the model
    protected $guarded = ['id'];


    // Filters


    // Relations


    // Accessors


    // Mutators


}
