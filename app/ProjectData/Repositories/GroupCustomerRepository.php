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
}
