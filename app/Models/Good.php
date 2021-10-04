<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::saved(function($model){
            Good::where('id',$model->id)->where('stock',0)->update(['status'=>2]);

        });
    }

    public function cateItem()
    {
        return $this->belongsTo(Cate::class,'cate_id','id');
    }

    public function labelItem()
    {
        return $this->belongsTo(Label::class,'label_id','id');
    }

    public function getPicturesAttribute($val)
    {
        return $val ? json_decode($val,true) : [];
    }

}
