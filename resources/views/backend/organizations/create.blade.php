<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir organización') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <x-form enctype="multipart/form-data" action="{{ route('organization.store') }}">
                        <div class="block mt-4">
                            <x-form-input name="name" label="Nombre de la organización" value="{{ old('name') }}" />
                        </div>
                        <div class="block mt-4">
                            <x-form-select name="type_id" label="Tipo">
                                <option value="">Selecciona el tipo de organización</option>
                                @foreach ($types as $type)
                                    <option @if($type->id == old('type_id')) selected  @endif value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </x-form-select>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="address" label="Dirección (línea 1)" value="{{ old('address') }}" />
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="address_2" label="Dirección (línea 2. Opcional)" value="{{ old('address_2') }}" />
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="city" label="Ciudad" value="{{ old('city') }}" />
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="postal_code" label="Código postal" value="{{ old('postal_code') }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-select name="province_id" label="Provincia">
                                <option value="">Selecciona la provincia</option>
                                @foreach ($provinces as $province)
                                    <option @if($province->id == old('province_id')) selected  @endif value="{{ $province->id }}">{{ $province->province }}</option>
                                @endforeach
                            </x-form-select>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="phone" label="Teléfono" value="{{ old('phone') }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="website" label="Sitio web" value="{{ old('website') }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="email" label="Email" value="{{ old('email') }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="image" type="file" accept="image/*" label="Imagen" value="{{ old('image') }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="logo" type="file" accept="image/*" label="Logotipo" value="{{ old('logo') }}"/>
                        </div>

                        <div class="block mt-4">
                            <x-form-submit>{{ 'Registrar organización' }}</x-form-submit>
                        </div>
                    </x-form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
