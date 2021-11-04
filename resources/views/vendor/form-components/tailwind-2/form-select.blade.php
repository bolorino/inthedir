<div class="mt-4">
    <label class="block">
        <x-form-label :label="$label" />

        <select
            @if($isWired())
                wire:model{!! $wireModifier() !!}="{{ $name }}"
            @endif

            name="{{ $name }}"

            @if($multiple)
                multiple
            @endif

            {!! $attributes->merge([
                'class' => ($label ? 'mt-1' : '') . ' block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent hover:border-red-400'
            ]) !!}>
            @forelse($options as $key => $option)
                <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                    {{ $option }}
                </option>
            @empty
                {!! $slot !!}
            @endforelse
        </select>
    </label>

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>