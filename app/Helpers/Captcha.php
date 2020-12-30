<?php

namespace App\Helpers;


class Captcha
{

    public static function google_v3($recaptchaCode = '')
    {

        // if google recaptcha not setuped
        if (env('APP_ENV') == 'local' || empty(env('RECAPTCHA_SITEKEY')) || empty(env('RECAPTCHA_SECRETKEY'))) {
            return true;
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('services.recaptcha.secretkey'),
            'response' => $recaptchaCode,
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);
        
        if ($resultJson->success != true || $resultJson->score <= 0.3) {
            return false;
        } else {
            return true;
        }
    }
}
