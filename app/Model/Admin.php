<?php

namespace App\Model;

use App\Helpers\Jdf;
use App\Traits\LockableTrait;
use Atriatech\Media\AtriatechMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    // use plugins here
    use LockableTrait, LogsActivity, AtriatechMedia;

    // Config the model    
    protected $guarded = ['id'];

    protected $hidden = ['password', 'remember_token'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'password', 'remember_token'];
    protected static $logName = 'admin';
    protected static $logOnlyDirty = true;


    // Filters
    // -------name
    public function scopeName($query, $name = NULL)
    {
        if (!empty($name)) {
            return $query->where('firstname', 'LIKE', "%$name%")->orWhere('lastname', 'LIKE', "%$name%");
        }
        return $query;
    }
    // ------- roleId
    public function scopeRoleId($query, $roleId = NULL)
    {
        if (!empty($roleId)) {
            return $query->where('role_id', $roleId);
        }
        return $query;
    }
    // -------
    public function scopeIsActive($query, $is_active = NULL)
    {
        if (!is_null($is_active)) {
            return $query->where('is_active', $is_active);
        }
        return $query;
    }

    // Relations
    // ---------
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // ---------
    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }
    // ---------
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificationable');
    }
    // --------
    public function support_details()
    {
        return $this->hasMany(Support_detail::class);
    }


    // Accessors
    // --------fullname
    public function getFullnameAttribute()
    {
        return $this->firstname . " " . $this->lastname;
    }
    // --------created at
    public function getCreatedAtAttribute($value)
    {
        if (config('app.locale') == 'fa') {
            return Jdf::gtoj($value, 'j F Y E G:i');
        }
        return $value;
    }


    // Mutators


}
