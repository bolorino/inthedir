<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Models\Organization;

class OrganizationsTable extends DataTableComponent
{

    public ?int $searchFilterDebounce = 500;

    public bool $responsive = true;

    /**
     * Needed to avoid messing with joins and results
     * @var string
     */
    public string $primaryKey = 'organization_id';

    public bool $columnSelect = false;

    public string $defaultSortColumn = 'name';

    public string $defaultSortDirection = 'asc';

    public array $perPageAccepted = [10,20];

    public function setTableClass(): ?string
    {
        return 'w-full divide-y border-collapse divide-gray-200';
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0';
    }

    public function setTableDataClass(Column $column, $row): ?string
    {
        return 'w-full lg:w-auto p-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-b block lg:table-cell lg:static';
    }

    public function columns(): array
    {
        return [
            Column::make('Teatro', 'name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('organization.datatables.name', compact('row'));
                })
                ->addClass('p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell'),
            Column::make('Municipio', 'city')
                ->searchable()
                ->addClass('p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell'),
            Column::make('Provincia', 'province')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('organization.datatables.province', compact('row'));
                })
                ->addClass('p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell'),
            Column::make('Editar')
                ->format(function ($value, $column, $row) {
                    return view('organization.datatables.edit', compact('row'));
                })
                ->addClass('p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell'),
            /*
            Column::make('Comunidad atónoma', 'state')
                ->sortable()
                 // @TODO Needs to sort the relation organization->province->state
                //->searchable()
                ->format(function ($value, $column, $row) {
                    return view('organization.datatables.state', compact('row'));
                })
                ->addClass('p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell'),
            */
        ];
    }

    public function query(): Builder
    {
        /**
         *
         */
        return Organization::query()
            ->select(['organizations.id AS organization_id', 'province_id', 'type_id', 'organizations.name',
                'organizations.slug', 'city',
                'provinces.id_state', 'provinces.province'])
                ->when($this->getFilter('type'), fn(Builder $query, string $type) => $query->where('type_id', '=', $type))
            ->join('provinces', 'province_id', '=', 'provinces.id');
            //->join('states', 'provinces.id_state', '=', 'states.id');
    }

    public function filters(): array
    {
        return [
            'type' => Filter::make('Tipo')
            ->select([
                '' => 'Todos',
                '1' => 'Teatros',
                '2' => 'Ayuntamientos',
                '10' => 'Festivales'
            ])
        ];
    }
}
