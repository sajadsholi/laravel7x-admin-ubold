<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission_category extends Model
{
    // use plugins here


    // Config the model
    protected $guarded = ['id'];


    // Filters


    // Relations
    // ---------
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    // Accessors


    // Mutators


}
