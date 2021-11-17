<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Province;
use http\Env\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class OrganizationTypeController extends Controller
{
    use HandlesAuthorization;

    private Collection $allowedTypes;

    public function setAllowedTypes(): void
    {
        if (!isset($this->allowedTypes)) {
            $this->allowedTypes = OrganizationType::select(['id', 'slug_plural'])
            ->get();
        }
    }

    public function list(string $type): View|\Illuminate\Http\Response
    {
        $this->setAllowedTypes();

        if (!$this->allowedTypes->contains('slug_plural', $type)) {
           return \response('No encontrado', 404);
        }

        $organizations = Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'type_id', 'organizations.name',
                'image', 'organizations.slug', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state',
                'organization_types.id', 'organization_types.name_plural AS type_name_plural',
                'organization_types.slug_plural AS type_slug_plural'])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->join('organization_types', 'type_id','=', 'organization_types.id')
            ->where('organization_types.slug_plural', '=', $type)
            ->orderBy('organizations.name')
            ->paginate(10, ['id']);

        return view('organization.nicelist',
            [
                'organizations' => $organizations
            ]);
    }

}
