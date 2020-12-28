<?php

namespace App\Model;

use App\Helpers\Jdf;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // use plugins here


    // Config the model
    protected $guarded = ['id'];


    // Filters
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

    // ------- receiver
    public function scopeReceiver($query, $receiver = NULL)
    {
        if (!empty($receiver)) {
            return $query->where('receiver', 'LIKE', "%$receiver%");
        }
        return $query;
    }

    // ------- title
    public function scopeTitle($query, $title = NULL)
    {
        if (!empty($title)) {
            return $query->where('title', 'LIKE', "%$title%");
        }
        return $query;
    }

    // ------- message
    public function scopeMessage($query, $message = NULL)
    {
        if (!empty($message)) {
            return $query->where('message', 'LIKE', "%$message%");
        }
        return $query;
    }

    // ------- type
    public function scopeType($query, $type = NULL)
    {
        if (!empty($type)) {
            return $query->where('type', $type);
        }
        return $query;
    }

    // ------- deviceId
    public function scopeDeviceId($query, $deviceId = NULL)
    {
        if (!empty($deviceId)) {
            return $query->where('device_id', $deviceId);
        }
        return $query;
    }


    // Relations
    // ---------morph
    public function notificationable()
    {
        return $this->morphTo();
    }

    // ---------
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Accessors
    // ---------token
    public function getTokenAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }
        return NULL;
    }
    // ---------template
    public function getTemplateAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }
        return NULL;
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
