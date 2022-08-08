<?php

namespace App\Http\Requests\Api\Templates;

use Awesome\Rest\Requests\AbstractFormRequest;

abstract class FilledIdsRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'ids' => 'filled|array',
            'ids.*' => 'required|uuid',
        ];
    }
}
