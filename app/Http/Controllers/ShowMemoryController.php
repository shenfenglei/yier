<?php

namespace App\HTTP\Controllers;

use App\Services\MailSendService;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class ShowMemoryController extends BaseController
{
    public function index(Request $request)
    {
        $arr = DB::table("memory")->select('*')->where("status", '<>', 2)->where('user_id', Auth::id())->orderBy('created_at','desc')->get()->toArray();
        foreach ($arr as $key => &$value) {
            if ($value->type == 2) {
                $value->finish_time = str_replace(' ', '号', $value->finish_time);
                $value->finish_time = $value->finish_time . '分';
            }
        }
        $return = self::getPage($arr, $request);
        $data   = [
            'list'      => $return['list'],
            'page_info' => $return['page_info']
        ];
        return view('memory/index', $data);
    }

    public function memAdd(Request $request)
    {
//        $avery   = $request->input('avery');
        $data   = [
            'user_id'     => Auth::id(),
            'created_at'  => date('Y-m-d H:i:s', time()),
            'updated_at'  => date('Y-m-d H:i:s', time()),
            'finish_time' => trim($request->input('mem_time')),
            'type'        => trim($request->input('type')),
//            'avery'        => trim($avery),
            'content'     => trim($request->input('mem_text'))
        ];
        $result = DB::table("memory")->insert($data);
        return redirect()->route('memoryIndex');
    }

    public function delMem(Request $request)
    {
        $id = $request->input('id');
        DB::table("memory")->where('id', $id)->update(['status' => 2]);
        echo 1;
    }

    public function login_do()
    {
        $iphone  = '18351388780';
        $content = '提醒小张';
        //把URL地址改成你自己就好了，把手机号码和信息模板套进去就行
        $url = 'http://api.sms.cn/sms/?=send&uid=shenfenglei&pwd=c2592ed9187215ffbbfa5738ba7e71b2&template=100006&mobile=' . $iphone . '&content={"code":"' . $content . '"}';
        /*$url='http://api.sms.cn/sms/?ac=send&uid=haoyunyun&pwd=ccd843e373206a246826181ab48ed1ee&template=384859&mobile='.$iphone.'&content={"code":"'.$code.'"}';*/
        $data   = array();
        $method = 'GET';
        $res    = $this->curlPost($url, $data, $method);
        echo $res;
    }

    /*curlpost传值*/
    public function curlPost1($url, $data, $method)
    {

        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($method == "POST") {//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }

    public function curlPost($url, $data, $method)
    {
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if ($method == "POST") {//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
}