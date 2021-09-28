<?php

namespace App\Admin\Repositories;

use App\Models\Commission as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Commission extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
