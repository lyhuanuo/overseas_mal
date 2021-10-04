<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Support\Facades\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Spatie\EloquentSortable\Sortable;

class Cate extends Model implements Sortable
{
	use HasDateTimeFormatter,ModelTree {
        ModelTree::boot as treeBoot;
    }
    protected $table = 'cate';
    protected $fillable = ['parent_id', 'order', 'title', 'icon'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->init();
    }

    protected function init()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.cate_table'));
    }

    protected static function booted()
    {
        static::treeBoot();
        parent::boot();
        static::deleting(function ($model) {

            if(Cate::where('parent_id',$model->id)->first()){
                throw new \Exception("该分类存在子分类，暂不支持删除");
            }
            if(Good::where('cate_id',$model->id)->whereRaw('deleted_at is null')->first()){
                throw new \Exception("该分类存在商品，暂不支持删除");
            }


            return true;
        });
    }




}
