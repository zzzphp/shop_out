<?php

namespace App\Admin\Repositories;

use App\Models\ServiceShop as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ServiceShop extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
