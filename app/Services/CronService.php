<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CronService
{
    public static function index()
    {
        return 123;
    }

    public static function noticeArrivalMem()
    {
        $return_data = [];
        $data_notice = [];
        $time        = date('Y-m-d H:i', time());
        $now          = date('Y-m', time());
        $data        = DB::table('memory')->join('users', 'users.id', '=', 'memory.user_id')->select(['memory.id', 'finish_time', 'content', 'email', 'name','type'])->whereRaw("case
 when type = 1 then left(finish_time,16)='".$time."'
 when type =2 then concat('".$now."','-',finish_time) = '".$time."'
  END")->where('status', '=', 0)->get()->toArray();
        if (empty($data)) {
            return '无数据可以执行';
        } else {
            foreach ($data as $key => $value) {
                if($value->type == 2){
                    $value->finish_time = str_replace(' ','号',$value->finish_time);
                    $value->finish_time = $value->finish_time.'分';
                    $value->type = '来自每月提醒';
                }
                else{
                    $value->type  = '来自每日提醒';
                }
                $value         = BaseController::objToArr($value);
                $flag          = MailSendService::send($value);
                $data_notice[] = $value['id'];
                if (!$flag) {
                    $return_data[] = $value['name'];
                }
            }
        }
        DB::table('memory')->whereIn('id', $data_notice)->where('type',1)->update(['status' => 1]);//已经通知的更新状态
        return implode(',', $return_data) . '提醒失败';
    }
}