<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/10/4
 * Time: 10:26
 */

namespace App\Http\Controllers\Web;

use App\Models\Cate;
use App\Models\Slideshow;

class IndexController extends BaseController
{

    /**
     * 获取轮播图
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSlideshowList()
    {
        $list = Slideshow::orderBy('sort')->get(['id','title','title_en','img_src','link_src'])->toArray();
        foreach($list as $k => $v){
            $list[$k]['img_src'] = $v['img_src'] ? env('APP_URL').'/uploads/'.$v['img_src'] : '';
        }
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$list]);
    }

    /**
     * 切换语言
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeLocale()
    {
        $lang = trim(request()->post('lang',''));
        if(!$lang){
            return response()->json(['code'=>201,'msg'=>trans('common.noChangeLang')]);
        }
        if(!in_array($lang,['zh_CN','en'])){
            return response()->json(['code'=>201,'msg'=>trans('common.langNoSupport')]);
        }
        session(['locale'=>$lang]);
        return response()->json(['code'=>200,'msg'=>trans('common.changeLocaleSuccess')]);
    }

    /**
     * 获取分类
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCateList()
    {
        $cateId = intval(request()->post('cate_id',0));
        $cateList = $this->cate;
        if($cateId){
            $cateList = Cate::where('id',$cateId)->orderBy('order')->get(['id','parent_id','title','title_en','icon','order'])->toArray();
            foreach($cateList as $k => $v){
                $cateList[$k]['icon'] = $v['icon'] ? env('APP_URL').'/uploads/'.$v['icon'] : '';
                $sonList = Cate::where('parent_id',$v['id'])->orderBy('order')->get(['id','parent_id','title','title_en','icon','order'])->toArray();
                foreach($sonList as $key => $val){
                    $sonList[$k]['icon'] = $val['icon'] ? env('APP_URL').'/uploads/'.$val['icon'] : '';
                }
                $cateList[$k]['sonCate'] = $sonList;
            }
        }
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$cateList]);
    }




}
