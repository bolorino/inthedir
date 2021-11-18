<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mt-12 mb-12">
        <article>
            <section class="mt-6 grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($organizations as $organization)
                    <article class="bg-white group relative rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                        <div class="relative w-full h-80 md:h-64 lg:h-44">
                            @if($organization->image)
                                <a href="{{ route('frontend.view', $organization->slug) }}">
                                    <img alt="{{ $organization->name }}" class="w-full h-full object-center object-cover"
                                         src="{{asset('storage/images/thumbnails/' . $organization->image)}}">
                                </a>
                            @endif
                        </div>
                        <div class="px-3 py-4">
                            <h3 class="text-sm text-gray-500 pb-2">
                                <a class="text-red-600 uppercase font-bold" href="{{ route('frontend.view', $organization->slug) }}">
                                    {{ $organization->name }}
                                </a>
                            </h3>
                            <p class="text-base text-gray-900 group-hover:text-red-700">
                                {{ $organization->city }}
                                <a href="{{ route('categoria', [$category, $organization->state_slug]) }}">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $organization->state_slug }}">
                                        {{ $organization->state }}
                                    </span>
                                </a>
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