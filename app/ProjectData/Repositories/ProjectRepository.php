<?php

namespace App\ProjectData\Repositories;

use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use App\ProjectData\Contracts\Repositories\ProjectRepository as RepositoryContract;

class ProjectRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->defaultFindRequest()->get();
    }

    public function findAll(): Collection
    {
        return $this->defaultFindRequest(false)->get();
    }

    public function findByIds(array $ids, bool $activeOnly = true): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->defaultFindRequest($activeOnly)->find($ids);
    }

    public function create(array $properties): ?Model
    {
        return $this->getModel()->newQuery()->create($properties);
    }

    private function defaultFindRequest(bool $activeOnly = true): Builder
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
            ])
            ->when($activeOnly, function (Builder $query) {
                return $query->where('is_active', true);
            })
            ->orderByDesc('started_at');
    }
}
