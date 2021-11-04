<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organizaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="mt-3 list-disc list-inside text-sm text-blue-600">
                        @foreach ($organizations as $organization)
                            <li class="p-2">
                                <a href="{{ route('organization.view', $organization->organization_id) }}">{{ $organization->name }}</a>
                                (<a href="{{ route('organizations.filter', ['province', $organization->province_id]) }}">{{ $organization->province }}</a>)
                                <a href="{{ route('organizations.filter', ['state', $organization->id_state]) }}">{{ $organization->state }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{ $organizations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
