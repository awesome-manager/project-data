<?php

namespace App\ProjectData\Repositories;

use App\ProjectData\Contracts\Repositories;
use App\ProjectData\Contracts\Repositories\Repository as RepositoryContract;

class Repository implements RepositoryContract
{
    public function groups(): Repositories\GroupRepository
    {
        return app(Repositories\GroupRepository::class);
    }

    public function statuses(): Repositories\StatusRepository
    {
        return app(Repositories\StatusRepository::class);
    }

    public function projects(): Repositories\ProjectRepository
    {
        return app(Repositories\ProjectRepository::class);
    }

    public function customers(): Repositories\CustomerRepository
    {
        return app(Repositories\CustomerRepository::class);
    }

    public function groupCustomer(): Repositories\GroupCustomerRepository
    {
        return app(Repositories\GroupCustomerRepository::class);
    }
}
