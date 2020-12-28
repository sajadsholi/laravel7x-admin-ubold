<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Region extends Model
{
    // use plugins here
    use LogsActivity, SoftDeletes;

    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'region';
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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    // ---------
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // Accessors


    // Mutators


}
