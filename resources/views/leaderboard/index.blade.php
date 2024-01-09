<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Leaderboard</h1>
                    @foreach ($leaderboardData as $data)
                        <h2 class="text-lg leading-6 font-medium text-black">{{ $data['location']->location }}</h2>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-4 border border-gray-300 dark:border-gray-600">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-600 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Lap Time
                                </th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-600 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    User
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($data['laps'] as $lap)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                        {{ $lap->lap_time }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                        {{ $lap->user->username }}
                                    </td>
                                    <!-- Add other lap details if needed -->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
