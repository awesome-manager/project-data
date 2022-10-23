<?php

namespace App\Http\Requests\Api\Project;

use App\ProjectData\Enums\ProjectType;
use Awesome\Rest\Requests\AbstractFormRequest;

class CreateRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:projects,code',
            'customer_id' => 'required|uuid|exists:customers,id',
            'group_id' => 'required|uuid|exists:groups,id',
            'type' => 'required|string|in:' . implode(', ', ProjectType::getTypes()),
            'status_id' => 'required|uuid|exists:statuses,id',
            'started_at' => 'filled|date',
            'ended_at' => 'filled|date|after:started_at',
            'budget' => 'filled|int',
            'expected_profitability' => 'filled|int|max:100',
            'average_rate' => 'filled|int',
            'comment' => 'filled|string',
            'is_active' => 'filled|boolean',
        ];
    }
}
