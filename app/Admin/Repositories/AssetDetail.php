<?php

namespace App\Admin\Repositories;

use App\Models\AssetDetails as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AssetDetail extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
