<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Teatros y espacios escénicos
        </h2>
    </x-slot>

    <div class="flex flex-col max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-5 px-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="my-5shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <livewire:organizations-table />
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
