<?php

namespace App\Repositories\Eloquent;

use App\Models\Beer;
use App\Repositories\Contracts\BeerRepositoryInterface;

class BeerRepository extends AbstractRepository implements BeerRepositoryInterface
{
    protected $model = Beer::class;
}
