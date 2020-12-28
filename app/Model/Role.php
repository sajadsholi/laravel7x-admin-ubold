<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    // use plugins here
    use LogsActivity;

    // Config the model
    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'guard'];
    protected static $logName = 'role';
    protected static $logOnlyDirty = true;

    // Filters
    // ------- name
    public function scopeName($query, $name = NULL)
    {
        if (!empty($name)) {
            return $query->where('name', 'LIKE', "%$name%");
        }
        return $query;
    }

    // Relations
    // ---------
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
    // ---------
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Accessors


    // Mutators


}
