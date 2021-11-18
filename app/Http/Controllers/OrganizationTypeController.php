<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Province;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class OrganizationTypeController extends Controller
{
    use HandlesAuthorization;

    private Collection $allowedTypes;

    public function __construct()
    {
        $this->setAllowedTypes();
    }

    public function setAllowedTypes(): void
    {
        \Log::info('Entering setAllowedTypes');
        if (!isset($this->allowedTypes)) {
            \Log::info('Set allowedTypes from DB');
            $this->allowedTypes = OrganizationType::select(['id', 'name_plural', 'slug_plural'])
            ->get();
        }
    }

    public function list(string $type): View|\Illuminate\Http\Response
    {
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
            ->paginate(8, ['id']);

        $searchTerm = $this->allowedTypes->firstWhere('slug_plural', $type);
        $title = 'Listado de ' . $searchTerm['name_plural'];

        if (\request('page') > 1) {
            $title .= '. Página ' . \request('page');
        }

        seo()->title($title);
        // seo()->description('Listado de teatros y salas de ' . $searchTerm);

        return view('organization.nicelist',
            [
                'organizations' => $organizations
            ]);
    }

}
