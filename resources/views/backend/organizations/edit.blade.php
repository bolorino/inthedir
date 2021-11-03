    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar organización :name', ['name' => $organization->name]) }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        <x-form enctype="multipart/form-data" action="{{ route('organization.update', $organization) }}">
                            @method('PUT')
                            <div class="block mt-4">
                                <x-form-input name="name" label="Nombre de la organización" value="{{ old('name', $organization->name) }}" />
                            </div>
                            <div class="block mt-4">
                                <x-form-select name="type_id" label="Tipo">
                                    <option value="">Selecciona el tipo de organización</option>
                                    @foreach ($types as $type)
                                        <option @if($type->id == old('type_id', $organization->type->id)) selected  @endif value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </x-form-select>
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="address" label="Dirección (línea 1)" value="{{ old('address', $organization->address) }}" />
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="address_2" label="Dirección (línea 2. Opcional)" value="{{ old('address_2', $organization->address_2) }}" />
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="city" label="Ciudad" value="{{ old('city', $organization->city) }}" />
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="postal_code" label="Código postal" value="{{ old('postal_code', $organization->postal_code) }}"/>
                            </div>
                            <div class="block mt-4">
                                <x-form-select name="province_id" label="Provincia">
                                    <option value="">Selecciona la provincia</option>
                                    @foreach ($provinces as $province)
                                        <option @if($province->id == old('province_id', $organization->province->id)) selected  @endif value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </x-form-select>
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="phone" label="Teléfono" value="{{ old('phone', $organization->phone) }}"/>
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="website" label="Sitio web" value="{{ old('website', $organization->website) }}"/>
                            </div>
                            <div class="block mt-4">
                                <x-form-input name="email" label="Email" value="{{ old('email', $organization->email) }}"/>
                            </div>
                            <div class="block mt-4">
                                @if($organization->image)
                                    <p class="">
                                        {{ $organization->image }}
                                    </p>
                                @endif
                                <x-form-input name="image" type="file" accept="image/*" label="Imagen" value="{{ old('image', $organization->image) }}" />
                            </div>
                            <div class="block mt-4">
                                @if($organization->logo)
                                    <p class="">
                                        {{ $organization->logo }}
                                    </p>
                                @endif
                                <x-form-input name="logo" type="file" accept="image/*" label="Logotipo" value="{{ old('logo', $organization->logo) }}" />
                            </div>
                            <div class="block mt-4">
                                <x-form-submit>{{ 'Actualizar organización' }}</x-form-submit>
                            </div>
                        </x-form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
