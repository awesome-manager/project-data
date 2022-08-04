<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface GroupCustomerRepository
{
    public function findByIds(array $ids): Collection;
}
