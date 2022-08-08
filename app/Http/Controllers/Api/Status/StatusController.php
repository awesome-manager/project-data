<?php

namespace App\Http\Controllers\Api\Status;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Status\StatusesRequest;
use App\Http\Resources\Api\Status\StatusesResource;
use Awesome\Foundation\Traits\Collections\Collectible;

class StatusController extends Controller
{
    use Collectible;

    public function findStatuses(StatusesRequest $request)
    {
        $statuses = $request->has('ids')
            ? Repository::statuses()->findByIds($request->query('ids', []))
            : Repository::statuses()->findAllActive();

        return response()->jsonResponse(
            (new StatusesResource($statuses))->toArray()
        );
    }
}
