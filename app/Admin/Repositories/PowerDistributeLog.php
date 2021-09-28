<?php

namespace App\Admin\Repositories;

use App\Models\PowerDistributeLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PowerDistributeLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
