<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CustomerRepository
{
    public function findAllActive(): Collection;

    public function findByIds(array $ids): Collection;
}
