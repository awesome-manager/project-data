<?php

namespace App\Http\Controllers\Api\Group;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\GroupsRequest;
use App\Http\Resources\Api\Group\GroupsResource;
use Awesome\Foundation\Traits\Collections\Collectible;

class GroupController extends Controller
{
    use Collectible;

    public function findGroups(GroupsRequest $request)
    {
        $groups = $request->has('ids')
            ? Repository::groups()->findByIds($request->query('ids', []))
            : Repository::groups()->findAllActive();

        $groupCustomer = $request->query('with_available')
            ? Repository::groupCustomer()->findByGroups($this->pluckUniqueAttr($groups, 'id'))
            : null;

        return response()->jsonResponse(
            (new GroupsResource(collect(compact('groups', 'groupCustomer'))))->toArray()
        );
    }
}
