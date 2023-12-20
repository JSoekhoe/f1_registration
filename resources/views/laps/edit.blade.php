<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lap') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('laps.update', ['lap' => $lap->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="location_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Location:
                            </label>
                            <select id="location_id" name="location_id" required
                                    class="mt-1 p-2 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md">
                                {{-- Populate the select options with allowed locations --}}
                                @foreach($allowedLocations as $location)
                                    <option value="{{ $location->id }}" {{ $lap->location_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="lap_datetime" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lap Date and Time:
                            </label>
                            <input type="datetime-local" id="lap_datetime" name="lap_datetime" required
                                   value="{{ \Carbon\Carbon::parse($lap->lap_datetime)->format('Y-m-d\TH:i') }}"
                                   class="mt-1 p-2 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md">
                        </div>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-500 active:bg-indigo-800">
                            Update Lap
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>