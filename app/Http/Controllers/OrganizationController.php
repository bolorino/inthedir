<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationPostRequest;
use App\Models\Organization;
use App\Models\Province;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use romanzipp\Seo\Structs\Meta;

class OrganizationController extends Controller
{
    use HandlesAuthorization;

    /**
     * @var Collection
     */
    private Collection $provinces;

    /**
     * @var array
     */
    private array $allowedFields;

    private array $imageTypes;

    private ?string $image = null;

    private ?string $logo = null;

    /**
     * @param Collection $provinces
     */
    public function setProvinces(Collection $provinces): void
    {
        $this->provinces = $provinces;
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
            'logo' => 'images/logos'
        ];
    }

    // @ToDo set the SEO via helper or Middleware

    public function index(): View
    {
        seo()->title('Inthedir: Directorio teatral');
        seo()->description('Directorio de teatros y salas alternativas en España');
        seo()->image('/images/inthedir.png');

        return view('home');
    }

    public function list(): View
    {
        seo()->title('Teatros y salas en España');
        seo()->description('Listado organizado de salas de teatro en España con datos de contacto.');

        $organizations = DB::table('organizations')
            ->select(['organizations.id AS organization_id', 'province_id', 'organizations.name', 'slug', 'city',
                'provinces.id_state', 'provinces.province', 'states.id', 'states.name AS state',
                'image', 'logo'])
            ->join('provinces', 'province_id', '=', 'provinces.id')
            ->join('states', 'provinces.id_state', '=', 'states.id')
            ->orderBy('organizations.name')
            ->paginate(10, ['organizations.id']);

        if ($organizations->currentPage() > 1) {
            seo()->title('Listado de teatros y salas en España página ' . $organizations->currentPage());
        }

        return view('organization.list', compact('organizations'));
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
        //$this->authorize('create', Organization::class);

        $this->setProvinces(Province::select(['id', 'id_state', 'province'])
            ->orderBy('id')
            ->get());

        return view('backend.organizations.create', [
            'provinces' => $this->provinces
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

        $this->setProvinces(Province::select(['id', 'id_state', 'province'])
            ->orderBy('id')
            ->get());

        return view('backend.organizations.edit', [
            'provinces' => $this->provinces, 'organization' => $organization
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

        $this->$type = $this->saveImage(
            $request->file($type), $type, $fileName . '.' . $request->file($type)->extension()
        );

        return true;
    }

    /**
     * @param UploadedFile $file
     * @param string $type
     * @param string $fileName
     * @return string
     */
    private function saveImage(UploadedFile $file, string $type, string $fileName): string
    {
        return Storage::disk('public')->putFileAs($this->imageTypes[$type], $file, $fileName);
    }
}
