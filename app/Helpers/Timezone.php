<?php

namespace App\Helpers;

class Timezone
{

    public static function set($timezone)
    {
        if (!empty(request()->user()) && !empty($timezone) && request()->user()->timezone != $timezone) {

            request()->user()->update([
                'timezone' => $timezone
            ]);
            // 
        }
    }
}
