<?php

namespace App\ProjectData\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\ProjectData\Contracts\Repositories\GroupCustomerRepository as RepositoryContract;

class GroupCustomerRepository extends AbstractRepository implements RepositoryContract
{
    public function findByIds(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'group_id', 'customer_id'])
            ->find($ids);
    }

    public function findByGroups(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'group_id', 'customer_id'])
            ->whereIn('group_id', $ids)
            ->get();
    }

    public function findByCustomers(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'group_id', 'customer_id'])
            ->whereIn('customer_id', $ids)
            ->get();
    }
}
