<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\ModelTree;

class Cate extends Model
{
	use HasDateTimeFormatter,ModelTree;
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
}
