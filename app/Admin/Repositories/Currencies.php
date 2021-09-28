<?php

namespace App\Admin\Repositories;

use App\Models\Currency as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Currencies extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
