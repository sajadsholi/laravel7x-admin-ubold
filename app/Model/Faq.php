<?php

namespace App\Model;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Faq extends Model implements ContractsTranslatable
{
    // use plugins here
    use LogsActivity, SoftDeletes, Translatable;

    // Config the model
    protected $guarded = ['id'];

    public $translatedAttributes = ['question', 'answer'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'deleted_at'];
    protected static $logName = 'faq';
    protected static $logOnlyDirty = true;

    // Filters
    // ------- question
    public function scopeQuestion($query, $question = NULL)
    {
        if (!empty($question)) {
            return $query->whereTranslationLike('question', "%$question%");
        }
        return $query;
    }


    // Relations


    // Accessors


    // Mutators


}
