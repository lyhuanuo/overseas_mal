<?php

namespace App\Admin\Repositories;

use App\Models\Slideshow as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Slideshow extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
