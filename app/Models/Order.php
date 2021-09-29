<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'order';

    public function orderGoodsItem()
    {
        return $this->belongsToMany(OrderGoods::class,'order_id','id');
    }


}
