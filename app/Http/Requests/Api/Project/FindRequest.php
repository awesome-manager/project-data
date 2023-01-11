<?php

namespace App\Http\Requests\Api\Project;

use Awesome\Rest\Requests\AbstractFormRequest;

class FindRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'ids' => 'filled|array',
            'ids.*' => 'required|uuid',
            'active_only' => 'filled|bool'
        ];
    }
}
