<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CustomerRepository
{
    public function findByIds(array $ids): Collection;
}
