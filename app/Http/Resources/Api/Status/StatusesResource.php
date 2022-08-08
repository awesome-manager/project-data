<?php

namespace App\Http\Resources\Api\Status;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusesResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'statuses' => $this->resource->map(function ($status) {
                return [
                    'id' => $this->string($status->id),
                    'code' => $this->string($status->code),
                    'title' => $this->string($status->title),
                ];
            })
        ];
    }
}
