<?php

namespace App\Admin\Repositories;

use App\Models\Carousel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Carousel extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
