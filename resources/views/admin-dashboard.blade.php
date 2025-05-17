<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Logout</button>
            </form>
        </h2>

        <livewire:ReserveSeats>

    </x-slot>


</x-app-layout>
