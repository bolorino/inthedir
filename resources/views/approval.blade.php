<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        Hola.<br>
                        Tu correo electrónico ya ha sido confirmado, pero tu cuenta aún está pendiente de aprovación.<br>
                        Recibirás un mensaje cuando tu cuenta sea aprovada por un administrador.
                    </p>

                    <h3>¿Por qué tiene que ser aprovada mi cuenta?</h3>
                    <p>
                        Para evitar que personas que nada tienen que ver con el mundo de las Artes Escénicas extraigan
                        direcciones y datos de la base de Inthedir de forma indiscriminada para hacer spam. <br>
                        Tan sólo necesitamos hacer unas comprobaciones rápidas y sencillas para confirmar tu relación
                        con el gremio. <br>
                        ¡No tardaremos mucho! Gracias.
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
