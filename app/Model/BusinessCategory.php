<?php

namespace App\Model;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Atriatech\Media\AtriatechMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class BusinessCategory extends Model implements ContractsTranslatable
{
    // use plugins here
    use LogsActivity, SoftDeletes, AtriatechMedia, Translatable;

    // Config the model
    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'link', 'meta_title', 'meta_keywords', 'meta_description'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'deleted_at'];
    protected static $logName = 'businessCategory';
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
    // ---------
    public function children()
    {
        return $this->hasMany(BusinessCategory::class, 'parent_id');
    }
    // ---------
    public function parent()
    {
        return $this->belongsTo(BusinessCategory::class, 'id', 'parent_id');
    }

    // Accessors


    // Mutators


}
