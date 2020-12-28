<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Support_status extends Model
{
    // use plugins here
    
    
    // Config the model
    protected $guarded = ['id'];
    
    
    // Filters
    
    
    // Relations
    // ---------
    public function supports()
    {
        return $this->hasMany(Support::class);
    }
    
    
    // Accessors
    
    
    // Mutators
    
    
}
