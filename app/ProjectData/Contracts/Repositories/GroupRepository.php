<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface GroupRepository
{
    public function findAllActive(): Collection;

    public function findByIds(array $ids): Collection;
}
