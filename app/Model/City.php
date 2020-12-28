<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    // use plugins here
    use LogsActivity;


    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'city';
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
    // --------
    public function region()
    {
        return $this->belongsTo(Region::class);
    }


    // Accessors


    // Mutators


}
