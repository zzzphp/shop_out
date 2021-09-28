<?php

namespace App\Admin\Repositories;

use App\Models\PayMethod as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PayMethod extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
