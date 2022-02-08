<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationPostRequest;
use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Province;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Str;

class OrganizationController extends Controller
{
    use HandlesAuthorization;

    /**
     * Available provinces from model
     * @var Collection
     */
    private Collection $provinces;

    /**
     * Available organization types from model
     * @var Collection
     */
    private Collection $organizationTypes;

    /**
     * Allowed fields to filter results
     * @var array
     */
    private array $allowedFields;

    /**
     * Main image or organization logo
     * @var array
     */
    private array $imageTypes;

    /**
     * @var string|null
     */
    private ?string $image = null;

    /**
     * @var string|null
     */
    private ?string $logo = null;

    public function setProvinces(): void
    {
        if (!isset($this->provinces)) {
            $this->provinces = Province::select(['id', 'id_state', 'province'])
                ->orderBy('id')
                ->get();
        }
    }

    public function setOrganizationTypes(): void
    {
        if (!isset($this->organizationTypes)) {
            $this->organizationTypes = OrganizationType::select(['id', 'name'])
                ->orderBy('id')
                ->get();
        }
    }

    /*
     * Set allowed fields to filter by
     */
    public function setAllowedFields(): void
    {
        $this->allowedFields = [
            'province',
            'state'
        ];
    }

    /*
     * Set allowed image types and path to save
     */
    public function setImageTypes(): void
    {
        $this->imageTypes = [
            'image' => 'images',
            'logo' => 'images/logos',
            'thumbnail' => 'images/thumbnails'
        ];
    }

    // @ToDo set the SEO via helper or Middleware

    public function list(): View
    {
        seo()->title('Teatros y salas en España');
        seo()->description('Listado organizado de salas de teatro en España con datos de contacto.');

        return view('organization.livelist');
    }

    public function viewBySlug(string $slug): View
    {
        $organization = Organization::firstWhere('slug', $slug);

        seo()->title($organization->name);
        seo()->description('Ficha de contacto de ' . $organization->name);

        if ($organization->image) {
            seo()->image($organization->image);
        }

        return view('organization.view', compact('organization'));
    }

    public function search(Request $search): View
    {
        $searchTerm = trim($search->post('term'));
        $title = 'Resultados para ' . $searchTerm;

        seo()->title($title);

        $organizations = Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'organizations.name', 'organizations.slug',
                'image', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state',
                'states.slug AS state_slug',])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->where('organizations.name', 'like', "%$searchTerm%")
            ->orWhere('city', '=', "$searchTerm")
            ->orWhere('provinces.province', '=', "$searchTerm")
            ->orderBy('organizations.name')
            ->paginate(10, ['id']);

        return view('organization.nicelist',
            [
                'organizations' => $organizations,
                'searchTerm' => $searchTerm,
                'title' => $title,
                'category' => 'teatros'
            ]);
    }

    public function filter(string $field, int $id): View|bool
    {
        $this->setAllowedFields();

        if (!in_array($field, $this->allowedFields)) {
            return false;
        }

        $whereColumn = 'province_id';
        $searchField = 'province';

        if ($field == 'state') {
            $whereColumn = 'states.id';
            $searchField = 'state';
        }

        $organizations = Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'organizations.name', 'organizations.slug', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state'])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->where($whereColumn, '=', $id)
            ->orderBy('organizations.name')
            ->paginate(10, ['id']);

        $searchTerm = $organizations->first()->$searchField;

        seo()->title('Teatros de ' . $searchTerm);
        seo()->description('Listado de teatros y salas de ' . $searchTerm);

        return view('organization.list',
            [
                'organizations' => $organizations,
                'searchTerm' => $searchTerm
            ]);
    }

    public function create(): View
    {
        $this->setProvinces();

        $this->setOrganizationTypes();

        return view('backend.organizations.create', [
            'provinces' => $this->provinces,
            'types' => $this->organizationTypes
        ]);
    }

    /**
     * @param OrganizationPostRequest $request
     * @return RedirectResponse
     */
    public function store(OrganizationPostRequest $request): RedirectResponse
    {
        $this->storeImage($request, 'image');
        $this->storeImage($request, 'logo');

        // Organization::create($request->safe()->except(['image', 'logo']));

        Organization::create([
            'name' => $request->post('name'),
            'province_id' => $request->post('province_id'),
            'type_id' => $request->post('type_id'),
            'address' => $request->post('address'),
            'address_2' => $request->post('address_2'),
            'city' => $request->post('city'),
            'postal_code' => $request->post('postal_code'),
            'phone' => $request->post('phone'),
            'website' => $request->post('website'),
            'email' => $request->post('email'),
            'image' => $this->image,
            'logo' => $this->logo
        ]);

        return redirect()->route('organization.list');
    }

    public function edit(Organization $organization): View
    {
        $this->setProvinces();

        $this->setOrganizationTypes();

        return view('backend.organizations.edit', [
            'provinces' => $this->provinces,
            'types' => $this->organizationTypes,
            'organization' => $organization
        ]);
    }

    /**
     * @param OrganizationPostRequest $request
     * @param Organization $organization
     * @return RedirectResponse
     */
    public function update(OrganizationPostRequest $request, Organization $organization): RedirectResponse
    {
        $this->image = $organization->image;
        $this->logo = $organization->logo;

        $this->storeImage($request, 'image');
        $this->storeImage($request, 'logo');

        //$organization->update($request->safe()->except(['image', 'logo']));

        $organization->update([
            'name' => $request->post('name'),
            'province_id' => $request->post('province_id'),
            'type_id' => $request->post('type_id'),
            'address' => $request->post('address'),
            'address_2' => $request->post('address_2'),
            'city' => $request->post('city'),
            'postal_code' => $request->post('postal_code'),
            'phone' => $request->post('phone'),
            'website' => $request->post('website'),
            'email' => $request->post('email'),
            'image' => $this->image,
            'logo' => $this->logo
        ]);

        return redirect()->route('organization.list')->with('status', 'Registro actualizado');
    }

    /**
     * Checks a valid image type is passed, set a proper filename and store it
     * @param Request $request
     * @param string $type
     * @return bool
     */
    public function storeImage(Request $request, string $type): bool
    {
        $this->setImageTypes();

        if (!isset($this->imageTypes[$type]) || empty($request->file($type))) {
            return false;
        }

        $fileName = Str::slug($request->post('name'));

        if ($type == 'logo') {
            $fileName .= '-logo';
        }

        // Save the image and set the image/logo name for DB
        $this->$type = saveImage(
            $request->file($type), $this->imageTypes[$type], $fileName . '.' . $request->file($type)->extension()
        );

        // Also generate thumbnail for the main image
        if ($type == 'image') {
            saveImage(
                $request->file($type), $this->imageTypes['thumbnail'], $fileName . '.' . $request->file($type)->extension()
            );
            $fullPath = public_path('storage/') . $this->imageTypes['thumbnail'] . '/' . $fileName . '.' . $request->file($type)->extension();
            createThumbnail($fullPath, 400, 450);
        }

        return true;
    }
}
