<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FaqTranslation extends Model
{
    // use plugins here
    use LogsActivity;


    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at' , 'deleted_at'];
    protected static $logName = 'faq';
    protected static $logOnlyDirty = true;


    // Filters


    // Relations


    // Accessors


    // Mutators


}
