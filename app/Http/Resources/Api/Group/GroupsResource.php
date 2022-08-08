<?php

namespace App\Http\Resources\Api\Group;

use Illuminate\Database\Eloquent\Collection;
use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupsResource extends ResourceCollection
{
    use Resourceable;

    private Collection $groups;
    private ?Collection $groupCustomer;

    public function __construct($resource)
    {
        $this->groups = $resource->get('groups');
        $this->groupCustomer = $resource->get('groupCustomer');

        parent::__construct($resource);
    }

    public function toArray($request = null)
    {
        $res = [
            'groups' => $this->groups->map(function ($group) {
                return [
                    'id' => $this->string($group->id),
                    'code' => $this->string($group->code),
                    'title' => $this->string($group->title)
                ];
            })
        ];

        if ($this->groupCustomer) {
            $res[ 'available_customers'] = $this->groupCustomer->map(function ($groupCustomer) {
                return [
                    'id' => $this->string($groupCustomer->id),
                    'group_id' => $this->string($groupCustomer->group_id),
                    'customer_id' => $this->string($groupCustomer->customer_id)
                ];
            });
        }

        return $res;
    }
}
