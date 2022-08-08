<?php

namespace App\Http\Requests\Api\Status;

use Awesome\Rest\Requests\AbstractFormRequest;

class StatusesRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'ids' => 'filled|array',
            'ids.*' => 'required|uuid',
        ];
    }
}
