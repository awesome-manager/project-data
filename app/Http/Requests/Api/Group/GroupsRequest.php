<?php

namespace App\Http\Requests\Api\Group;

use Awesome\Rest\Requests\FilledIdsRequest;

class GroupsRequest extends FilledIdsRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'with_available' => 'filled|boolean'
        ]);
    }
}
