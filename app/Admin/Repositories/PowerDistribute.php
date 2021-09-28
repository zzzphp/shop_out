<?php

namespace App\Admin\Repositories;

use App\Models\PowerDistribute as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PowerDistribute extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
