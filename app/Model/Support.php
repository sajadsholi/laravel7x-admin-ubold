<?php

namespace App\Model;

use App\Helpers\Jdf;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    // use plugins here


    // Config the model
    protected $guarded = ['id'];


    // Filters
    // ------- ticketId
    public function scopeTicketId($query, $ticketId = NULL)
    {
        if (!empty($ticketId)) {
            return $query->where('id', $ticketId);
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

    // ------- userId
    public function scopeUserId($query, $userId = NULL)
    {
        if (!empty($userId)) {
            return $query->where('user_id', $userId);
        }
        return $query;
    }

    // ------- subject
    public function scopeSubject($query, $subject = NULL)
    {
        if (!empty($subject)) {
            return $query->where('subject', 'LIKE', "%$subject%");
        }
        return $query;
    }

    // ------- statusId
    public function scopeStatusId($query, $statusId = NULL)
    {
        if (!empty($statusId)) {
            return $query->where('status_id', $statusId);
        }
        return $query;
    }

    // Relations
    // ---------
    public function status()
    {
        return $this->belongsTo(Support_status::class);
    }

    // --------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --------
    public function support_details()
    {
        return $this->hasMany(Support_detail::class);
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
