<?php

namespace App\ProjectData\Services;

use Illuminate\Support\Arr;
use App\Facades\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\GroupCustomerNotFoundException;
use App\ProjectData\Contracts\Services\ProjectService as ServiceContract;

class ProjectService implements ServiceContract
{
    public function create(array $properties): ?Model
    {
        $groupCustomer = Repository::groupCustomer()->getByGroupAndCustomer(
            $properties['group_id'],
            $properties['customer_id']
        );

        if (is_null($groupCustomer)) {
            throw new GroupCustomerNotFoundException();
        }

        $properties['group_customer_id'] = $groupCustomer->id;

        return Repository::projects()->create(Arr::only($properties, [
            'title',
            'code',
            'group_customer_id',
            'type',
            'status_id',
            'started_at',
            'ended_at',
            'budget',
            'expected_profitability',
            'average_rate',
            'comment',
            'is_active'
        ]));
    }
}
