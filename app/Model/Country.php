<?php

namespace App\Model;

use Atriatech\Media\AtriatechMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Country extends Model
{
    // use plugins here
    use LogsActivity, AtriatechMedia, SoftDeletes;

    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'country';
    protected static $logOnlyDirty = true;


    // Filters
    // ------- name
    public function scopeName($query, $name = NULL)
    {
        if (!empty($name)) {
            return $query->where('name', 'LIKE', "$name");
        }
        return $query;
    }

    // Relations
    // ---------
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    // ---------
    public function cities()
    {
        return $this->hasManyThrough(Region::class, City::class);
    }

    // Accessors


    // Mutators


}
