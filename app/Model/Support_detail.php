<?php

namespace App\Model;

use App\Helpers\Jdf;
use Illuminate\Database\Eloquent\Model;

class Support_detail extends Model
{
    // use plugins here


    // Config the model
    protected $guarded = ['id'];


    // Filters


    // Relations
    // --------
    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    // ---------
    public function admin()
    {
        return $this->belongsTo(Admin::class);
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
