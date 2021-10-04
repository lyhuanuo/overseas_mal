<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/10/4
 * Time: 18:08
 */

namespace App\Http\Controllers\Web;


use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGoods;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function createOrder()
    {
        $lang = session('locale','zh_CN');
        try{
            DB::beginTransaction();
            //检测商品是否售罄
            $carGoodsItem = request()->post('goodsItem',[]);
            if(!is_array($carGoodsItem) || empty($carGoodsItem)){
                throw new \Exception(trans('common.orderGoodsExist'));
            }
            $name = trim(request()->post('name',''));
            $phone = trim(request()->post('phone',''));
            $address = trim(request()->post('address',''));
            if(!$name){
                throw new \Exception(trans('common.nameEmpty'));
            }
            if(!$phone){
                throw new \Exception(trans('common.phoneEmpty'));
            }
            if(!$address){
                throw new \Exception(trans('common.addressEmpty'));
            }
            $totalPrice = $totalNum = 0;
            foreach($carGoodsItem as $k => $v){
                if(!isset($v['goods_id']) || empty(intval($v['goods_id']))|| !isset($v['num']) || empty(intval($v['num']))){
                    throw new \Exception(trans('common.requestError'));
                }
                $goodsInfo = Good::where('id',$v['goods_id'])->first(['id','name','name_en','item_no','price','stock','status']);
                if(!$goodsInfo){
                    if($lang != 'zh_CN'){
                        throw new \Exception('购物车商品中有不存在的商品或者已被删除');
                    }else{
                        throw new \Exception('There are items in the shopping cart that do not exist or have been deleted!');
                    }
                }
                if($lang == 'zh_CN'){
                    $goodsName = $goodsInfo->name ? $goodsInfo->name : $goodsInfo->item_no;
                }else{
                    $goodsName = $goodsInfo->name_en ? $goodsInfo->name_en : $goodsInfo->item_no;
                }
                if($goodsInfo->status == 2){
                    if($lang == 'zh_CN'){
                        throw new \Exception('下单失败，其中商品【'.$goodsName.'】已下架');
                    }else{
                        throw new \Exception('Failed to place an order, of which 【'.$goodsName.'】 items have been removed from the shelf!');
                    }
                }
                if($goodsInfo->stock < $v['num']){
                    if($lang == 'zh_CN'){
                        throw new \Exception('下单失败，其中商品【'.$goodsName.'】库存不足，剩余库存：'.$goodsInfo->stock);
                    }else{
                        throw new \Exception('Failed to place the order, in which the 【'.$goodsName.'】 inventory of goods is insufficient, and the remaining inventory is:'.$goodsInfo->stock.'!');
                    }
                }
                $totalNum += $v['num'];
                $carGoodsItem[$k]['goods_name'] = $goodsName;
                $carGoodsItem[$k]['price']   = $goodsInfo->price;
                $carGoodsItem[$k]['total_price'] = $goodsInfo->price * $v['num'];
                $totalPrice += $carGoodsItem[$k]['total_price'] * 100;

            }
            $totalPrice = sprintf("%.2f",$totalPrice /100) ;

            $orderInfo = Order::create([
                'order_sn'           => $this->createOrderSn(),
                'date'              => date('Y-m-d'),
                'name'              => $name,
                'phone'             => $phone,
                'address'           => $address,
                'total_num'         => $totalNum,
                'total_price'       => $totalPrice,
                'pay_type'          => 0,
                'status'            => 1,
            ]);


            if(!$orderInfo){
                throw new \Exception(trans('common.orderError'));
            }
            $time = date('Y-m-d H:i:s');
            foreach($carGoodsItem as $key => $val){
                $updateGoods = Good::where('id',$val['goods_id'])->where('status',1)->where('stock','>=',$val['num'])->decrement('stock',$val['num']);
                if(!$updateGoods){
                    if($lang == 'zh_CN'){
                        throw new \Exception('下单失败，其中商品【'.$val['goods_name'].'】减库存失败');
                    }else{
                        throw new \Exception('Failed to place the order, in which the inventory reduction of goods 【'.$val['goods_name'].'】 failed!');
                    }
                }
                Good::where('id',$val['goods_id'])->where(['status'=>1,'stock'=>0])->update(['status'=>2]);
                $save = OrderGoods::create([
                    'order_id'          => $orderInfo->id,
                    'goods_id'          => $val['goods_id'],
                    'price'             => $val['price'],
                    'num'               => $val['num'],
                    'total_price'       => $val['total_price'],
                ]);
                if(!$save){
                    throw new \Exception(trans('common.orderError'));
                }
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['code'=>201,'msg'=>$e->getMessage()]);
        }
        return response()->json(['code'=>200,'msg'=>trans('common.orderSuccess')]);

    }

    public function searchOrder()
    {
        $phone = trim(request()->post('phone',''));
        if(!$phone){
            return response()->json(['code'=>201,'msg'=>trans('common.requestError')]);
        }
        $page = intval(request()->post('page',1));
        $limit = intval(request()->post('limit',10));
        $list = Order::with(['orderGoodsItem'=>function($query){
            return $query->select(['order_id','goods_id','price','num','total_price']);
        }])->where('phone',$phone)->orderBy('id')->offset(($page-1)*$limit)->limit($limit)->get(['id','order_sn','date','name','phone','total_num','total_price','pay_type','express_no','status','pay_at','delivery_at','created_at'])->toArray();
        $count = Order::where('phone',$phone)->count();
        $totalPage = ceil($count/$limit);

        foreach($list as $k => $v){
            $orderGoodsItem = $v['order_goods_item'];
            if($orderGoodsItem){
                foreach($orderGoodsItem as $key => $val){
                    if(isset($orderGoodsItem[$key]['goods_item']['img_src'])){
                        $orderGoodsItem[$key]['goods_item']['img_src'] = $val['goods_item']['img_src']  ? env('APP_URL').'/uploads/'.$val['goods_item']['img_src']: '';
                    }
                }
            }
            $list[$k]['order_goods_item'] = $orderGoodsItem ? $orderGoodsItem : [];
        }

        $data = [
            'list'          => $list,
            'totalPage'     => $totalPage,
        ];
        return response()->json(['code'=>200,'msg'=>trans('common.requestSuccess'),'data'=>$data]);

    }


}
