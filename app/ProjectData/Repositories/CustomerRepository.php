<?php

namespace App\ProjectData\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\ProjectData\Contracts\Repositories\CustomerRepository as RepositoryContract;

class CustomerRepository extends AbstractRepository implements RepositoryContract
{
    public function findByIds(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'name', 'surname'])
            ->where('is_active', true)
            ->find($ids);
    }
}
