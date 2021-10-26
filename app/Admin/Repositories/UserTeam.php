<?php

namespace App\Admin\Repositories;

use App\Models\UserTeam as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UserTeam extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
