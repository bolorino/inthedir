<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teatros y espacios escénicos {{ $searchTerm ?? '' }}
        </h2>
    </x-slot>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mt-12 mb-12">
        <article>
            <section class="mt-6 grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($organizations as $organization)
                    <article class="bg-white group relative rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                        <div class="relative w-full h-80 md:h-64 lg:h-44">
                            @if($organization->image)
                                <img alt="{{ $organization->name }}" class="w-full h-full object-center object-cover" src="{{asset('storage/images/thumbnails/' . $organization->image)}}">
                            @endif
                        </div>
                        <div class="px-3 py-4">
                            <h3 class="text-sm text-gray-500 pb-2">
                                <a class="text-red-600 uppercase font-bold" href="{{ route('frontend.view', $organization->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $organization->name }}
                                </a>
                            </h3>
                            <p class="text-base text-gray-900 group-hover:text-red-700">
                                {{ $organization->city }}
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
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
                                    @case('Cantabria')
                                    bg-red-600 text-white
                                    @break
                                    @case('Castilla - La Mancha')
                                    bg-red-900 text-white
                                    @break
                                    @case('Extremadura')
                                    bg-green-600 text-white
                                    @break
                                @endswitch
                            ">
                                {{ $organization->state }}
                            </span>
                        </div>
                    </article>
                @endforeach
            </section>
        </article>

        <div class="my-9">
            {{ $organizations->links() }}
        </div>
    </section>

</x-guest-layout>