<?php

namespace App\Model;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TermsOfService extends Model implements ContractsTranslatable
{
    // use plugins here
    use LogsActivity, Translatable;

    // Config the model
    protected $guarded = ['id'];

    protected $table = 'terms_of_service';

    public $translatedAttributes = ['content'];


    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'termsOfService';
    protected static $logOnlyDirty = true;
    // Filters


    // Relations


    // Accessors


    // Mutators


}
