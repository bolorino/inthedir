<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inthedir ßeta') }}
        </h2>
    </x-slot>

    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-300 dark:text-gray-500 underline">Panel</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-300 dark:text-gray-500 underline">Acceder</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-300 dark:text-gray-500 underline">Registrarse</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="text-center my-9">
        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block xl:inline">Inthedir</span>
            <span class="block text-red-600 xl:inline">directorio teatral</span>
        </h1>

        <div class="flex justify-center p-4">
            <img src="{{ asset('storage/images/logos/inthedir-icon-big.png') }}" alt="Inthedir" class="" />
        </div>

        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Este proyecto está actualmente en fase ßeta. <br>
            Actualmente hay {{ $totalRegisters }} registros
        </p>

    </div>
</x-guest-layout>
