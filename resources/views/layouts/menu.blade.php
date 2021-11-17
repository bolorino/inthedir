<div class="flex-1 flex flex-col">
    <nav x-data="{ open: false }" class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex items-center px-2 lg:px-0">
                    <div class="flex-shrink-0">
                        <a href="/"><img class="block lg:hidden h-8 w-auto" src="{{ asset('storage/images/logos/icon-inthedir-header.png') }}" alt="Inthedir"></a>
                        <a href="/"><img class="hidden lg:block h-8 w-auto" src="{{ asset('storage/images/logos/logo-inthedir-header.png') }}" alt="Inthedir"></a>
                    </div>
                    <div class="hidden lg:block lg:ml-6">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{ route('categoria', 'teatros') }}" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Teatros</a>
                            @can('view data')
                                <a href="{{ route('categoria', 'ayuntamientos') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Ayuntamientos</a>
                            @endcan
                            @role('super-admin|editor')
                                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Panel</a>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                    <div class="max-w-lg w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <x-form action="{{ route('escenarios.search') }}">
                                <input id="term" name="term" class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 sm:text-sm" placeholder="Buscar" type="search">
                            </x-form>
                        </div>
                    </div>
                </div>
                <div class="flex lg:hidden">
                    <!-- Mobile menu button -->
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" x-bind:aria-expanded="open" aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <!-- Icon when menu is closed. -->
                        <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': open, 'block': !open }" class="block h-6 w-6" x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <!-- Icon when menu is open. -->
                        <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': !open, 'block': open }" class="hidden h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ route('categoria', 'teatros') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Teatros</a>
                @can('view data')
                    <a href="{{ route('categoria', 'ayuntamientos') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Ayuntamientos</a>
                @endcan
                <!--<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Ayuntamientos</a>-->
            </div>
        </div>
    </nav>
</div>
