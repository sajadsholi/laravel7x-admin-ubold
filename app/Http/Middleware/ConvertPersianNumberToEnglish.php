<?php

namespace App\Http\Middleware;


use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertPersianNumberToEnglish extends TransformsRequest
{
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [0,  1,  2,  3,  4,  4,  5,  5,  6,  6,  7,  8,  9];
        return str_replace($persian, $english, $value);
    }
}
