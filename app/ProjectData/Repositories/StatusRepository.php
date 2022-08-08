<?php

namespace App\ProjectData\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\ProjectData\Contracts\Repositories\StatusRepository as RepositoryContract;

class StatusRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'code', 'title'])
            ->where('is_active', true)
            ->get();
    }

    public function findByIds(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'code', 'title'])
            ->where('is_active', true)
            ->find($ids);
    }
}
