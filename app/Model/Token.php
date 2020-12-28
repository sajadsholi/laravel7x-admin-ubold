<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    // use plugins here


    // Config the model
    protected $guarded = ['id'];


    // Filters


    // Relations
    // --------- morph
    public function tokenable()
    {
        return $this->morphTo();
    }

    // ---------
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Accessors


    // Mutators


}
