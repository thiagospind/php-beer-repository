<?php

namespace App\Repositories\Eloquent;

use App\Models\Beer;
use App\Models\BeerStyle;
use App\Repositories\Contracts\BeerRepositoryInterface;
use App\Repositories\Contracts\BeerStyleRepositoryInterface;

class BeerStyleRepository extends AbstractRepository implements BeerStyleRepositoryInterface
{
    protected $model = BeerStyle::class;
}
