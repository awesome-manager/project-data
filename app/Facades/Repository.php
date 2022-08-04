<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\ProjectData\Contracts\Repositories;
use App\ProjectData\Contracts\Repositories\Repository as RepositoryContract;

/**
 * @method static Repositories\GroupRepository groups()
 * @method static Repositories\StatusRepository statuses()
 * @method static Repositories\ProjectRepository projects()
 * @method static Repositories\CustomerRepository customers()
 * @method static Repositories\GroupCustomerRepository groupCustomer()
 */
class Repository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RepositoryContract::class;
    }
}
