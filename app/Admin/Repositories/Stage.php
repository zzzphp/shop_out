<?php

namespace App\Admin\Repositories;

use App\Models\Stage as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Stage extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
