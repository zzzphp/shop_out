<?php

namespace App\Admin\Repositories;

use App\Models\Ally as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Ally extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
