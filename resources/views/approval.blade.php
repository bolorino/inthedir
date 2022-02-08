<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 max-w-md bg-white border-b border-gray-200">
                    <p class="mb-3">
                        Hola {{ $name }}.<br>
                        Tu correo electrónico ya ha sido confirmado, pero tu cuenta aún está pendiente de aprobación.<br>
                        Recibirás un mensaje cuando tu cuenta sea aprobada por un administrador.
                    </p>

                    <h3 class="text-2xl mb-3">¿Por qué tiene que ser aprobada mi cuenta?</h3>
                    <p class="mb-3">
                        Para evitar que personas que nada tienen que ver con el mundo de las Artes Escénicas extraigan
                        direcciones y datos de la base de Inthedir de forma indiscriminada para hacer spam.
                    </p>
                    <p class="mb-3">
                        Tan sólo necesitamos hacer unas comprobaciones rápidas y sencillas para confirmar tu relación
                        con el gremio.
                    </p>

                    <h3 class="text-2xl mb-3">¿Qué ocurre cuando se aprueba mi cuenta?</h3>
                    <p class="mb-3">
                        Una vez aprobada, podrás ver los datos de contacto completos de la base de datos,
                        como los correos de contacto, por ejemplo.
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
