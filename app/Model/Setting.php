<?php

namespace App\Model;

use Atriatech\Media\AtriatechMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    // use plugins here
    use LogsActivity, AtriatechMedia;

    // Config the model
    protected $guarded = ['id'];


    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'generalSettings';
    protected static $logOnlyDirty = true;

    // Filters


    // Relations


    // Accessors


    // Mutators


}
