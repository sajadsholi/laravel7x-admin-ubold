<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PageTranslation extends Model
{
    // use plugins here
    use LogsActivity;

    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'deleted_at'];
    protected static $logName = 'page';
    protected static $logOnlyDirty = true;

    // Filters


    // Relations


    // Accessors


    // Mutators


}
