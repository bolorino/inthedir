<div class="mt-6 flex items-center justify-between">
    <button {!! $attributes->merge([
        'class' => 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline',
        'type' => 'submit'
    ]) !!}>
        {!! trim($slot) ?: __('Submit') !!}
    </button>
</div>