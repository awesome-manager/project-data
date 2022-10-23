<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\{Model, Collection};

interface GroupCustomerRepository
{
    public function findByIds(array $ids): Collection;

    public function findByGroups(array $ids): Collection;

    public function findByCustomers(array $ids): Collection;

    public function getByGroupAndCustomer(string $groupId, string $customerId): ?Model;
}
