<?php

namespace App\Admin\Repositories;

use App\Models\CurrencyMarketBiki as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CurrencyMarketBiki extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
