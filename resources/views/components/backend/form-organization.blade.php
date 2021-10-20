@if ($organization->exists)
    <form class="flex flex-col w-full" method="POST" action="{{ route($action, $organization) }}">
    @method('put')
@else
    <form class="flex flex-col w-full" method="POST" action ="{{ route($action) }}">
@endif

    @csrf
    <div class="block mt-4">
        <x-form-input name="name" label="Nombre de la organización" value="{{ old('name', $organization->name) }}" />
    </div>
    <div class="block mt-4">
        <x-form-input name="address" label="Dirección (línea 1)" value="{{ old('address', $organization->address) }}" />
    </div>
    <div class="block mt-4">
        <x-form-input name="address_2" label="Dirección (línea 2. Opcional)" value="{{ old('address_2"', $organization->address_2) }}" />
    </div>
    <div class="block mt-4">
        <x-form-input name="city" label="Ciudad" value="{{ old('city', $organization->city) }}" />
    </div>
    <div class="block mt-4">
        <x-form-input name="postal_code" label="Código postal" value="{{ old('postal_code', $organization->postal_code) }}"/>
    </div>
    <div class="block mt-4">
        <x-form-select name="province" label="Provincia">
            <option value="">Selecciona la provincia</option>
            @foreach ($provinces as $province)
                @if ($organization->exists)
                    <option @if($province->id == old('province', $organization->province->id)) selected  @endif value="{{ $province->id }}">{{ $province->province }}</option>
                @else
                    <option @if($province->id == old('province')) selected  @endif value="{{ $province->id }}">{{ $province->province }}</option>
                @endif
            @endforeach
        </x-form-select>
    </div>
    <div class="block mt-4">
        <x-form-submit>{{ ($organization->exists ? 'Actualizar' : 'Registrar organización') }}</x-form-submit>
    </div>
</form>
