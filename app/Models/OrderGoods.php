<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'order_goods';

    public function goodsItem()
    {
        return $this->belongsTo(Good::class,'goods_id','id');
    }


}
