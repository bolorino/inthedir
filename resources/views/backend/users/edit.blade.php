<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar usuario :name', ['name' => $user->name]) }}
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
                    <x-form action="{{ route('user.update', $user->id) }}">
                        @method('PUT')
                        <div class="block mt-4">
                            <x-form-input name="name" label="Nombre de usuario" value="{{ old('name', $user->name) }}" />
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="email" label="Email" value="{{ old('email', $user->email) }}"/>
                        </div>
                        <div class="block mt-4">
                            <x-form-input name="password_update" label="Contraseña" value=""/>
                        </div>
                        <div class="block mt-4">
                            <x-form-submit>{{ 'Actualizar usuario' }}</x-form-submit>
                        </div>
                    </x-form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
