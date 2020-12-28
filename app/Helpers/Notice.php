<?php

namespace App\Helpers;

class Notice
{
    //iOS
    private $sibAppId = "";
    private $sibAppKey = "";
    private $iOSToken = "";

    //FireBase (Android & Admin)
    private $firebaseKey = "AAAAVQik9cg:APA91bGutvMbrAXr4wKZo7auiitc0ZhyEQlEjtwZHelwywA2OKXYzfYSAHpJHVpPghFIQjfY4mg12Vq4jOB1bSoBC8ETuC6cGNkmtzwPHX3jgoIJMfCQ3P1i-MACsnYZruWxiTd1TSP2";
    private $firebaseSenderId = "365217248712";

    public static function send_firebase($tokens = [], $data = [], $link = null)
    {
        if (empty($tokens) || empty($data)) {
            return false;
        }

        $fields = [
            "registration_ids" => $tokens,
            "priority" => "high",
            "data" => $data
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            "Authorization:key=" . self::$firebaseKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }


    public static function send_ios($tokens = [], $data = [])
    {
        if (empty($tokens) || empty($data)) {
            return false;
        }

        $fields = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $data['title'],
                "body" => $data['msg'],
                "sound" => 'default',
            ],
            "badge" => 1,
            "priority" => "high",
            "data" => $data
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            "Authorization:key=" . self::$firebaseKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return ['res' => $response, 'fields' => json_decode($fields)];
    }


    public static function send_admin($tokens = [], $data = [], $link = null)
    {
        if (empty($tokens) || empty($data)) {
            return false;
        }

        $fields = [
            "registration_ids" => $tokens,
            "priority" => "high",
            "notification" => [
                "body" => $data['msg'],
                "title" => $data['title'],
                // 'icon' => 'https://pizzawifi.com/logo-firebase.png',
                'click_action' => $link
            ],
            "data" => $data
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            "Authorization:key=" . self::$firebaseKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }
}
