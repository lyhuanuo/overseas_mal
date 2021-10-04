<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/10/4
 * Time: 13:38
 */

namespace App\Http\Controllers\Web;


use App\Models\Cate;
use App\Models\Good;

class GoodsController extends BaseController
{
    /**
     * 获取所有商品或者通过分类获取商品
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsList()
    {
        $cateId = intval(request()->post('cate_id',0));
        $page = request()->post('page',1);
        $limit = request()->post('limit',20);
        if($cateId){
            $cateArr  = Cate::where('parent_id',$cateId)->pluck('id')->toArray();
            $list = Good::where('status',1)->whereIn('cate_id',array_merge($cateArr,[$cateId]))->orderBy('sort')->offset(($page-1)*$limit)->limit($limit)->get(['id','cate_id','label_id','name','name_en','item_no','keywords','keywords_en','descr','descr_en','img_src','price','stock','sort'])->toArray();
            $count = Good::where('status',1)->whereIn('cate_id',array_merge($cateArr,[$cateId]))->count();
        }else{
            $list = Good::where('status',1)->orderBy('sort')->offset(($page-1)*$limit)->limit($limit)->get(['id','cate_id','label_id','name','name_en','item_no','keywords','keywords_en','descr','descr_en','img_src','price','stock','sort'])->toArray();
            $count = Good::where('status',1)->count();
        }
        $totalPage = ceil($count/$limit);
        foreach($list as $k => $v){
            $list[$k]['img_src'] = $v['img_src']  ? env('APP_URL').'/uploads/'.$v['img_src'] : '';
        }
        $data = [
            'list'          => $list,
            'totalPage'     => $totalPage,
        ];
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$data]);
    }

    /**
     * 获取热门商品
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHotGoodsList()
    {
        $page = request()->post('page',1);
        $limit = request()->post('limit',20);
        $list = Good::where('status',1)->where('label_id',2)->orderBy('sort')->offset(($page-1)*$limit)->limit($limit)->get(['id','cate_id','label_id','name','name_en','item_no','keywords','keywords_en','descr','descr_en','img_src','price','stock','sort'])->toArray();
        $count = Good::where('status',1)->where('label_id',2)->count();
        $totalPage = ceil($count/$limit);
        foreach($list as $k => $v){
            $list[$k]['img_src'] = $v['img_src']  ? env('APP_URL').'/uploads/'.$v['img_src'] : '';
        }
        $data = [
            'list'          => $list,
            'totalPage'     => $totalPage,
        ];
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$data]);

    }

    /**
     * 搜索商品
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $search = trim(request()->post('keywords',''));
        if(!$search){
            return response()->json(['code'=>201,'msg'=>trans('common.requestError')]);
        }
        $page = intval(request()->post('page',1));
        $limit = intval(request()->post('limit',20));
        $list = Good::where('status',1)->where(function($query) use($search){
            return $query->where('name','like','%'.$search.'%')->orWhere('name_en','like','%'.$search.'%')->orWhere('item_no','like','%'.$search.'%');
        })->orderBy('sort')->offset(($page-1)*$limit)->limit($limit)->get(['id','cate_id','label_id','name','name_en','item_no','keywords','keywords_en','descr','descr_en','img_src','price','stock','sort'])->toArray();
        $count = Good::where('status',1)->where(function($query) use($search){
            return $query->where('name','like','%'.$search.'%')->orWhere('name_en','like','%'.$search.'%')->orWhere('item_no','like','%'.$search.'%');
        })->count();
        $totalPage = ceil($count/$limit);
        foreach($list as $k => $v){
            $list[$k]['img_src'] = $v['img_src']  ? env('APP_URL').'/uploads/'.$v['img_src'] : '';
        }
        $data = [
            'list'          => $list,
            'totalPage'     => $totalPage,
        ];
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$data]);
    }

    /**
     * 获取商品详情
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsDetail()
    {
        $goodsId = intval(request()->post('goods_id',0));
        if(!$goodsId){
            return response()->json(['code'=>201,'msg'=>trans('requestError')]);
        }
        $fieldArr = ['id','cate_id','label_id','name','name_en','item_no','keywords','keywords_en','descr','descr_en','img_src','price','stock','pictures','content','content_en','sort'];
        $info = Good::with(['cateItem','labelItem'])->where('id',$goodsId)->first($fieldArr);
        if(!$info){
            return response()->json(['code'=>201,'msg'=>trans('goodsNoExist')]);
        }
        $info->img_src = $info->img_src  ? env('APP_URL').'/uploads/'.$info->img_src : '';
        $pictures = $info->pictures;
        foreach($pictures as $k => $v){
            $pictures[$k] = $v ? env('APP_URL').'/uploads/'.$v : '';
        }
        $info->pictures = $pictures;

        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$info->toArray()]);
    }


}
