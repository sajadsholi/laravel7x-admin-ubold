<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    // use plugins here
    use LogsActivity;

    // Config the model
    protected $table = 'contact';

    protected $guarded = ['id'];

    // log
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logName = 'contactUs';
    protected static $logOnlyDirty = true;


    // Filters


    // Relations


    // Accessors
    // ---------contact number
    public function getContactNumberAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }
        return $value;
    }
    // ---------Address
    public function getAddressAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }
        return $value;
    }
    // ---------Email
    public function getEmailAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }
        return $value;
    }

    // Mutators


}
