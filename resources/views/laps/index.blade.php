<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laps') }}
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

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Lap ID
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Location
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Date and Time
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($laps as $lap)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $lap->lap_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $lap->location}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $lap->lap_datetime }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
{{--                                    <a href="{{ route('laps.edit', ['lap' => $lap]) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600">--}}
{{--                                        Edit--}}
{{--                                    </a>--}}
                                    <form method="post" action="{{ route('laps.destroy', ['lap' => $lap]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this lap?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
