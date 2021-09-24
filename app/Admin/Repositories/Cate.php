<?php

namespace App\Admin\Repositories;

use App\Models\Cate as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Cate extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
