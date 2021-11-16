<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $organization->name }}
        </h2>
    </x-slot>

    <section class="relative pt-12 bg-blueGray-50">
        <div class="items-center flex flex-wrap">
            <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
                @if($organization->image)
                    <img alt="{{ $organization->name }}" class="max-w-full rounded-lg shadow-lg" src="{{asset('storage/' . $organization->image)}}">
                @endif
            </div>
            <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
                <div class="md:pr-12">
                    <h2 class="text-3xl font-semibold mb-2">{{ $organization->name }}</h2>
                    @if($organization->logo)
                        <img alt="{{ $organization->name }} logo" class="max-w-full" src="{{asset('storage/' . $organization->logo)}}">
                    @endif

                    <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                        {{ $organization->city }} <br>
                        {{ $organization->address }} <br>
                        @if($organization->address_2)
                            {{ $organization->address_2 }} <br>
                        @endif
                        {{ $organization->postal_code }} - {{ $organization->province->province }} <br>

                        @if($organization->phone)
                            {{ $organization->phone }} <br>
                        @endif

                        @can('view data')
                            @if($organization->email)
                                {{ $organization->email }} <br>
                            @endif
                        @endcan

                        @if($organization->website)
                            <a href="{{ $organization->website }}" class="inline-flex items-center font-semibold transition-colors duration-200 text-red-600 hover:text-red-400">{{ $organization->website = preg_replace('#^https?://#', '', rtrim($organization->website,'/')) }}</a> <br>
                        @endif

                        {{ $organization->province->state->name }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
