<?php

namespace App\Admin\Repositories;

use App\Models\DistributesAutomatic as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DistributesAutomatic extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
