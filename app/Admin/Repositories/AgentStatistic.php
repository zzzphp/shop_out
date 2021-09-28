<?php

namespace App\Admin\Repositories;

use App\Models\AgentStatistics as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AgentStatistic extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
