<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class About extends Model implements TranslatableContract
{
    // use plugins here
    use LogsActivity, Translatable;

    // Config the model
    protected $guarded = ['id'];

    protected $table = 'about';

    public $translatedAttributes = ['content'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'aboutUs';
    protected static $logOnlyDirty = true;

    // Filters


    // Relations


    // Accessors


    // Mutators


}
