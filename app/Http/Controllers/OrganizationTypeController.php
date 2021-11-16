<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Province;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class OrganizationTypeController extends Controller
{
    use HandlesAuthorization;

    public function list(string $type): View
    {
        $organizations = Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'type_id', 'organizations.name', 'organizations.slug', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state',
                'organization_types.id', 'organization_types.name_plural AS type_name_plural',
                'organization_types.slug_plural AS type_slug_plural'])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->join('organization_types', 'type_id','=', 'organization_types.id')
            ->where('organization_types.slug_plural', '=', $type)
            ->orderBy('organizations.name')
            ->paginate(10, ['id']);

        return view('organization.list',
            [
                'organizations' => $organizations
            ]);
    }

}
