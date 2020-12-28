<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // use plugins here
    
    
    // Config the model
    protected $guarded = ['id'];
    
    
    // Filters
    
    
    // Relations
    // ---------
    public function category()
    {
        return $this->belongsTo(Permission_category::class);
    }
    // ---------
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    // Accessors
    
    
    // Mutators
    
    
}
