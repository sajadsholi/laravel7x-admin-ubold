<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    // use plugins here

    // Config the model
    protected $guarded = ['id'];


    // Filters


    // Relations
    // ---------
    public function application_setting()
    {
        return $this->hasOne(ApplicationSetting::class);
    }

    // ---------
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    // ---------
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }


    // Accessors


    // Mutators


}
