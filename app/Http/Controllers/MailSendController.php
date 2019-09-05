<?php

namespace App\HTTP\Controllers;

use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSendController extends BaseController
{
   public function index(){
        $flag = Mail::send('mail',['data'=>123],function($message){
            $to='bruce.shen@ibaiqiu.com';
            $message->to($to)->subject('测试邮件');
        });

        if($flag){
            echo 1;
        }
   }
}