<div class="relative rounded overflow-hidden shadow-lg">
    <span class="absolute top-0 right-0">
        <button wire:click="$emit('closeModal')">
            <svg class="h-12 w-12 fill-current text-white hover:text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </button>
    </span>
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
