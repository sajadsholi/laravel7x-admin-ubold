<?php

namespace App\Model;

use App\Helpers\Jdf;
use Atriatech\Media\AtriatechMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{

    // use plugins here
    use Notifiable, LogsActivity, AtriatechMedia;

    // Config the model
    protected $guarded = ['id', 'email_verified_at', 'remember_token'];

    protected $hidden = ['password', 'remember_token', 'verify_code'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at', 'password', 'remember_token', 'email_verified_at', 'verifyCode'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;

    // Filters
    //--------
    public function scopeName($query, $name = NULL)
    {
        if (!empty($name)) {
            return $query->where(function ($query) use ($name) {
                $query->orWhere('firstname', 'LIKE', "%$name%")
                    ->orWhere('lastname', 'LIKE', "%$name%")
                    ->orWhere('fullname', 'LIKE', "%$name%");
            });
        }
        return $query;
    }
    //--------
    public function scopeMobile($query, $mobile = null)
    {
        if (!is_null($mobile)) {
            return $query->where('mobile', 'LIKE', $mobile);
        }
        return $query;
    }
    //--------
    public function scopeIsActive($query, $is_active = null)
    {
        if (!is_null($is_active)) {
            return $query->where('is_active', $is_active);
        }
        return $query;
    }

    // ------- fromDate
    public function scopeFromDate($query, $fromDate = NULL)
    {
        if (!empty($fromDate)) {

            $fromDate = (config('app.locale') == 'fa') ? Jdf::jtog($fromDate, 'Y-m-d H:i:s') : $fromDate;

            return $query->where('created_at', '>=', $fromDate);
        }
        return $query;
    }
    // ------- toDate
    public function scopeToDate($query, $toDate = NULL)
    {
        if (!empty($toDate)) {

            $toDate = (config('app.locale') == 'fa') ? Jdf::jtog($toDate, 'Y-m-d H:i:s') : $toDate;

            return $query->where('created_at', '<=', $toDate);
        }
        return $query;
    }


    // Relations
    // ---------
    public function supports()
    {
        return $this->hasMany(Support::class);
    }
    // ---------
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificationable');
    }

    // ---------
    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    // Accessors
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
