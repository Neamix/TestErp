<?php 

namespace App\Http\Helpers;

use App\Mail\DefaultEmail;
use Illuminate\Support\Facades\Mail;

class Mailer {
    static function verifyUser($user,$token) {
        $send['title'] = 'Verify Account';
        $send['email'] = $user->email;
        $send['name']  = $user->name;
        $send['token'] = $token;
        $send['view']  = 'emails.verifyEmail';
        self::sendEmail($send);
    }

    static function sendEmail($data) {
        Mail::to($data['email'])->queue(new DefaultEmail($data));
    }
}