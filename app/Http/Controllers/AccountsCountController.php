<?php

namespace App\HTTP\Controllers;

use App\Services\MailSendService;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class AccountsCountController extends BaseController
{
    private $type = [
        '1' => '-',
        '2' => '+'
    ];

    public function index(Request $request)
    {
        $content     = '';
        $total       = [];
        $today       = date('Y-m-d', time());
        $month       = date('Y-m', time());
        $year        = date('Y', time());
        $arr         = DB::table("account_acount")->select('*')->where('user_id', Auth::id())->orderBy('created_at', 'desc');
        $today_money = DB::table("account_acount")->select(DB::raw('ifnull(sum(if(num<0,-num,0)),0) as pay,ifnull(sum(if(num>0,num,0)),0) as get'))->where('created_at', 'like', $today . '%')->where('user_id', Auth::id());
        $monty_money = DB::table("account_acount")->select(DB::raw('ifnull(sum(if(num<0,-num,0)),0) as pay,ifnull(sum(if(num>0,num,0)),0) as get'))->where('created_at', 'like', $month . '%')->where('user_id', Auth::id());
        $year_money  = DB::table("account_acount")->select(DB::raw('ifnull(sum(if(num<0,-num,0)),0) as pay,ifnull(sum(if(num>0,num,0)),0) as get'))->where('created_at', 'like', $year . '%')->where('user_id', Auth::id());
        if ($request->input('content1')) {
            $content     = trim($request->input('content1'));
            $arr         = $arr->where('content', 'like', '%' . $content . '%');
            $today_money = $today_money->where('content', 'like', '%' . $content . '%');
            $monty_money = $monty_money->where('content', 'like', '%' . $content . '%');
            $year_money  = $year_money->where('content', 'like', '%' . $content . '%');
        }
        $arr                = $arr->get()->toArray();
        $today_money        = $today_money->get()->toArray();//统计当日
        $monty_money        = $monty_money->get()->toArray();//统计当月
        $year_money         = $year_money->get()->toArray();//统计当年
        $total['today_pay'] = $today_money[0]->pay;
        $total['today_get'] = $today_money[0]->get;
        $total['month_pay'] = $monty_money[0]->pay;
        $total['month_get'] = $monty_money[0]->get;
        $total['year_pay']  = $year_money[0]->pay;
        $total['year_get']  = $year_money[0]->get;
        $return             = self::getPage($arr, $request);
        $data               = [
            'list'      => $return['list'],
            'total'     => $total,
            'content'   => $content,
            'page_info' => $return['page_info']
        ];
        return view('account/index', $data);
    }

    public function accountAdd(Request $request)
    {
        $type   = $this->type[$request->input('type')];
        $data   = [
            'user_id'    => Auth::id(),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
            'num'        => $type . $request->input('num'),
            'content'    => trim($request->input('content'))
        ];
        $result = DB::table("account_acount")->insert($data);
        return redirect()->route('accountIndex');
    }

    public function delAccount(Request $request)
    {
        $id = $request->input('id');
        DB::table("account_acount")->where('id', $id)->delete();
        echo 1;
    }
}