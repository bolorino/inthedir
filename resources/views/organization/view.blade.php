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

                        @if($organization->website)
                            <a href="{{ $organization->website }}" class="inline-flex items-center font-semibold transition-colors duration-200 text-red-600 hover:text-red-400">{{ $organization->website = preg_replace('#^https?://#', '', rtrim($organization->website,'/')) }}</a> <br>
                        @endif

                        {{ $organization->province->state->name }}
                    </p>
                </div>
            </div>
        </div>
        <footer class="relative  pt-8 pb-6 mt-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                        <div class="text-sm text-blueGray-500 font-semibold py-1">
                            Creado por @bolorino.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</x-guest-layout>
