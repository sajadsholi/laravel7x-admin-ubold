<?php

namespace App\Model;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model implements ContractsTranslatable
{
    // use plugins here
    use LogsActivity, SoftDeletes, Translatable;

    // Config the model
    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'content'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'deleted_at'];
    protected static $logName = 'page';
    protected static $logOnlyDirty = true;

    // Filters
    // ------- name
    public function scopeName($query, $name = NULL)
    {
        if (!empty($name)) {
            return $query->whereTranslationLike('name', "%$name%");
        }
        return $query;
    }


    // Relations


    // Accessors


    // Mutators


}
