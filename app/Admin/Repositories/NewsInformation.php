<?php

namespace App\Admin\Repositories;

use App\Models\NewsInformation as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class NewsInformation extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
