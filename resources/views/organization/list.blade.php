<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teatros y espacios escénicos {{ $searchTerm ?? '' }}
        </h2>
    </x-slot>

    <div class="flex flex-col max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-5 px-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                @if($organizations->count() == 0)
                    <h2 class="text-gray-600 text-2xl font-bold">Lo sentimos, no se han encontrado resultados para {{ $searchTerm }}</h2>
                @else
                <div class="my-5shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ciudad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comunidad Autónoma
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody x-max="2">
                            @php
                                $rowclass = 'bg-white';
                            @endphp

                            @foreach ($organizations as $organization)
                                <tr class="{{ $rowclass }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <strong><a href="{{ route('frontend.view', $organization->slug) }}">{{ $organization->name }}</a></strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('escenarios.filter', ['province', $organization->province_id]) }}">{{ $organization->province }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @switch ($organization->state)
                                                @case('Andalucía')
                                                    bg-green-100 text-green-800
                                                @break
                                                @case('Aragón')
                                                    bg-red-100 text-red-800
                                                @break
                                                @case('Asturias, Principado de')
                                                    bg-blue-100 text-blue-800
                                                @break
                                                @case('Balears, Illes')
                                                    bg-yellow-100 text-red-800
                                                @break
                                                @case('Catalunya')
                                                    bg-red-800 text-yellow-100
                                                @break
                                                @case('Canarias')
                                                    bg-yellow-300 text-blue-800
                                                @break
                                            @endswitch
                                        ">
                                            <a href="{{ route('escenarios.filter', ['state', $organization->id_state]) }}">{{ $organization->state }}</a>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('edit organizations')
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <a href="{{ route('organization.edit', $organization->organization_id) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    Editar
                                                </a>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                                @php
                                    if ($rowclass == 'bg-white') $rowclass = 'bg-gray-50';
                                    else $rowclass = 'bg-white';
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                {{ $organizations->links() }}
            </div>
        </div>

    </div>
</x-guest-layout>
