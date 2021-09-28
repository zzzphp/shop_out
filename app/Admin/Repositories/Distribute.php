<?php

namespace App\Admin\Repositories;

use App\Models\Distribute as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Distribute extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
