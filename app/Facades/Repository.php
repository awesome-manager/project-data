<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\ProjectData\Contracts\Repositories;
use App\ProjectData\Contracts\Repositories\Repository as RepositoryContract;

/**
 * @method static
 */
class Repository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RepositoryContract::class;
    }
}
