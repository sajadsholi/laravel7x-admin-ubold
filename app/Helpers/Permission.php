<?php

namespace App\Helpers;

class Permission
{
    public static function can($name)
    {
        $canArray = config('can');
        if (property_exists($canArray, $name)) {
            return true;
        } else {
            return false;
        }
    }
}
