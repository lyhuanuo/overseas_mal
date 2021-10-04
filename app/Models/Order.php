<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'order';
    public $fillable = [
        'mid','order_sn','date','name','phone','total_num','total_price','pay_type','pay_info','express_no','status','pay_at','delivery_at'
    ];

    public function orderGoodsItem()
    {
        return $this->hasMany(OrderGoods::class,'order_id','id')->with(['GoodsItem'=>function($query){
            return $query->select(['id','name','name_en','item_no','img_src'])->withTrashed();
        }]);
    }


}
