<?php

namespace App\Http\Controllers\User\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class NotificationSendController extends Controller
{
    public function updateDeviceToken(Request $request)
    {
        Auth::user()->device_token = $request->token;

        Auth::user()->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = 'AAAANPt3SJI:APA91bF_gxrIoSlxH6j544E_ZeX71fGd4qgyKuyXN72l44ok_FdxDU32gMK6vLMZoMs0W0cufeS_gJ6O1JwaF5X-aRx8l7fPbIs5KfphbSX6x7-VK-d4wjG8qQ_q3hnh-2eSjLhHI0cu'; // Add Server Key Here Provided By FCM

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, true);
        // Disabling SSL: Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if($result === FALSE){
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
    }
}