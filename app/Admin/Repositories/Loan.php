<?php

namespace App\Admin\Repositories;

use App\Models\Loan as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Loan extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
