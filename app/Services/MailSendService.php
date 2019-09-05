<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailSendService{
    public static function send($data){
//        $name = DB::table('users');
        $flag = Mail::send('mail',$data,function($message) use ($data){
            $to=$data['email'];
            $message->to($to)->subject('注意:事件提醒');
        });
        if($flag){
            return true;
        }
        else {
            return false;
        }
    }
}