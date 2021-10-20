<div class="@if($type === 'hidden') hidden @else mt-4 @endif">
    <label class="block text-sm font-medium text-gray-700">
        <x-form-label :label="$label" />

        <input {!! $attributes->merge([
            'class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 ' . ($label ? 'mt-1' : '')
        ]) !!}
            @if($isWired())
                wire:model{!! $wireModifier() !!}="{{ $name }}"
            @else
                value="{{ $value }}"
            @endif

            name="{{ $name }}"
            type="{{ $type }}" />
    </label>

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
