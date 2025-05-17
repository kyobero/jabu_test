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

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('reserve-seat') }}" class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-lg space-y-6">
                        <!-- CSRF Token for Laravel -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h2 class="text-2xl font-bold text-center text-black">Purchase Seat</h2>

                        <!-- User Select -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-black">
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                            </select>
                        </div>

                        <!-- Event Select -->
                        <div>
                            <label for="event_id" class="block text-sm font-medium text-gray-700">Event</label>
                            <select name="event_id" id="event_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-black">
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Seat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Seat_map</label>
                            <div class="grid grid-cols-5 gap-2">
                                @foreach ($seats as $seat)
                                    <label class="relative group">
                                        <input type="radio" name="seat_id" value="{{ $seat->id }}" class="peer hidden" {{ $seat->is_reserved ? 'disabled' : '' }}>
                                        <div class="w-12 h-12 flex items-center justify-center rounded-md cursor-pointer
                        peer-checked:bg-blue-600 peer-checked:text-black
                        {{ $seat->is_reserved ? 'bg-gray-300 cursor-not-allowed' : 'bg-green-200 hover:bg-green-300' }}">
                                            {{ $seat->id }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition">
                                Purchase Seat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
