<?php
/**
 * User: Bruce
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    private static $size = 10;

    public static function objToArr($obj)
    {
        if (is_object($obj)) {
            $obj = (array)$obj;
        }
        if (is_array($obj)) {
            foreach ($obj as $key => $value) {
                $obj[$key] = self::objToArr($value);
            }
        }
        return $obj;
    }

    public static function getPage($list, $params)
    {
        $route = $params->route()->getName();
        if (!isset($params['page']) || !is_numeric($params['page'])) {
            $params['page'] = 1;
        }
        $collection          = collect($list);
        $total_num           = count($list);//总记录数
        $page_count          = ceil($total_num / self::$size);//总页数
        $params['page']      = $params['page'] > $page_count ? $page_count : $params['page'];
        $params['page']      = $params['page'] < 1 ? 1 : $params['page'];
        $current_page        = $params['page'];
        $page_info           = ['current_page' => $current_page, 'total' => $total_num, 'last_page' => $page_count, 'page_size' => self::$size, 'route' => $route];
        $return['page_info'] = $page_info;
        $chunk               = $collection->forPage($params['page'], self::$size);
        $return['list']      = $chunk->all();
        return $return;
    }
}