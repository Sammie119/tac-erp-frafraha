<?php

namespace App\Services;

use GuzzleHttp\Client;

class SmsService
{
    public static function sendSms($to, $message): string
    {
        $client = new Client();
        $apiKey = config('tacpress.api_key');//env('SMS_API_KEY');
        $endpoint = config('tacpress.api_endpoint');
        $sender_id = config('tacpress.sender_id');
        $action = config('tacpress.action');

        $response = $client->get($endpoint, [
            'query' => [
                'action' => $action,
                'api_key' => $apiKey,
                'to' => $to,
                'from' => $sender_id,
                'sms' => $message,
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
