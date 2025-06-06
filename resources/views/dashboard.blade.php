<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(auth()->user()->role == 'Admin')
                <x-jet-welcome />

                @elseif(auth()->user()->role == 'Catering')
                <x-jet-welcome />
                @else
                <x-jet-welcome />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
