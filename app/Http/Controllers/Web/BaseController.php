<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/10/4
 * Time: 10:18
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Config;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    public $config = [];
    public $cate = [];
    public function __construct()
    {
        $this->config = $this->_getConfig();
        $this->cate = $this->_getCate();
    }

    /**
     * 获取配置
     * @return mixed
     */
    public function _getConfig()
    {
        $configCache = Cache::get('configCache');
        if(!$configCache){
            $configCache = Config::where('id',1)->first()->toArray();
            $configCache['logo_src'] = $configCache['logo_src'] ? env('APP_URL').'/uploads/'.$configCache['logo_src'] : '';
            Cache::put('configCache',$configCache);
        }
        return $configCache;
    }

    /**
     * 获取分类
     * @return mixed
     */
    public function _getCate()
    {
        $cateConfig = Cache::get('cateConfig');
        if(!$cateConfig){
            $cateConfig = Cate::where('parent_id',0)->orderBy('order')->get(['id','parent_id','title','title_en','icon','order'])->toArray();
            foreach($cateConfig as $k => $v){
                $cateConfig[$k]['icon'] = $v['icon'] ? env('APP_URL').'/uploads/'.$v['icon'] : '';
                $sonList = Cate::where('parent_id',$v['id'])->orderBy('order')->get(['id','parent_id','title','title_en','icon','order'])->toArray();
                foreach($sonList as $key => $val){
                    $sonList[$k]['icon'] = $val['icon'] ? env('APP_URL').'/uploads/'.$val['icon'] : '';
                }
                $cateConfig[$k]['sonCate'] = $sonList;
            }
            Cache::put('cateConfig',$cateConfig);
        }
        return $cateConfig;
    }

    /**
     * 创建订单号
     * @return string
     */
    protected function createOrderSn()
    {
//        $code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
//        $osn = 'D' . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        $osn = 'D' . date("Ymd") . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));

        return $osn;
    }




}
