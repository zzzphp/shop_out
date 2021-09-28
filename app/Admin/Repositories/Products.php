<?php

namespace App\Admin\Repositories;

use App\Models\Product as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Products extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
