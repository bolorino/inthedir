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

    public function setAllowedFields()
    {
        $this->allowedFields = [
            'province',
            'state'
        ];
    }

    public function setImageTypes()
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

        seo()->title('Resultados para ' . $searchTerm);

        $organizations = Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'organizations.name', 'slug', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state'])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->where('organizations.name', 'like', "%$searchTerm%")
            ->orWhere('city', '=', "$searchTerm")
            ->orWhere('provinces.province', '=', "$searchTerm")
            ->orderBy('organizations.name')
            ->paginate(10, ['id']);

        return view('organization.list',
            [
                'organizations' => $organizations,
                'searchTerm' => $searchTerm
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
            ->select(['organizations.id AS organization_id', 'province_id', 'organizations.name', 'slug', 'city',
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
        $this->checkFile($request, 'image');
        $this->checkFile($request, 'logo');

        Organization::create([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'type_id' => $request->type_id,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'website' => $request->website,
            'email' => $request->email,
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

        $this->checkFile($request, 'image');
        $this->checkFile($request, 'logo');

        $organization->update([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'type_id' => $request->type_id,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'website' => $request->website,
            'email' => $request->email,
            'image' => $this->image,
            'logo' => $this->logo
        ]);

        return redirect()->route('organization.list');
    }

    /**
     * Checks a valid image type is passed and set a proper filename
     * @param Request $request
     * @param string $type
     * @return bool
     */
    public function checkFile(Request $request, string $type): bool
    {
        $this->setImageTypes();

        if (!isset($this->imageTypes[$type]) || empty($request->file($type))) {
            return false;
        }

        $fileName = \Str::slug($request->name);

        if ($type == 'logo') {
            $fileName .= '-logo';
        }

        // Save the image and set the image/logo name for DB
        $this->$type = saveImage(
            $request->file($type), $this->imageTypes[$type], $fileName . '.' . $request->file($type)->extension()
        );

        // Also generate thumbnail for main image
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
