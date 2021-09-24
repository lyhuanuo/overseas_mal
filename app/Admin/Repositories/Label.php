<?php

namespace App\Admin\Repositories;

use App\Models\Label as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Label extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
