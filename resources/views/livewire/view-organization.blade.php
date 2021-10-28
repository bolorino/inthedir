<div class="rounded overflow-hidden shadow-lg">
    @if($organization->image)
        <img alt="{{ $organization->name }}" class="w-full h-48 max-h-full md:max-h-screen" src="{{asset('storage/' . $organization->image)}}">
    @endif
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $organization->name }}</div>
        @if($organization->logo)
            <img alt="{{ $organization->name }} logo" class="max-w-md max-h-36" src="{{asset('storage/' . $organization->logo)}}">
        @endif
        <p class="text-gray-700 text-base">
            {{ $organization->city }} <br>

            @if($organization->website)
                <a href="{{ $organization->website }}" class="inline-flex items-center font-semibold transition-colors duration-200 text-red-600 hover:text-red-400">{{ $organization->website = preg_replace('#^https?://#', '', rtrim($organization->website,'/')) }}</a> <br>
            @endif
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $organization->province->state->name }}</span>
    </div>
</div>
