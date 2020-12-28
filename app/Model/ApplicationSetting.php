<?php

namespace App\Model;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ApplicationSetting extends Model implements ContractsTranslatable
{
    // use plugins here
    use LogsActivity, Translatable;

    // Config the model
    protected $guarded = ['id'];

    public $translatedAttributes = ['update_message'];


    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'applicationSettings';
    protected static $logOnlyDirty = true;

    // Filters


    // Relations
    // ---------
    public function device()
    {
        return $this->belongsTo(Device::class);
    }


    // Accessors


    // Mutators


}
