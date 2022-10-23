<?php

namespace App\ProjectData\Repositories;

use Illuminate\Database\Eloquent\{Model, Collection};
use App\ProjectData\Contracts\Repositories\ProjectRepository as RepositoryContract;

class ProjectRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select([
                'id',
                'title',
                'group_customer_id',
                'type',
                'status_id',
                'budget',
                'expected_profitability',
                'average_rate',
                'comment',
                'started_at',
                'ended_at'
            ])->where('is_active', true)
            ->orderByDesc('started_at')
            ->get();
    }

    public function create(array $properties): ?Model
    {
        return $this->getModel()->newQuery()->create($properties);
    }
}
