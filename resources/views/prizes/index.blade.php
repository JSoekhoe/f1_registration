<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prizes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4 sm:px-20 bg-white border-b border-gray-200">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prize Giver</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($prizes as $prize)
                            <tr>
                                <td>{{ $prize->title }}</td>
                                <td>{{ $prize->description }}</td>
                                <td>{{ $prize->prizeGiver }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto sm:px-6 lg:px-8">
        @foreach($prizes as $prize)
            <div class="p-4 mb-4 bg-white border rounded shadow">
                <h1 class="text-2xl font-semibold">{{ $prize->title }}</h1>
                <p>{{ $prize->description }}</p>

                @if($prize->title === 'first race' && $prize->lap && !$prize->lap->validated)
                    <p class="text-red-500">Complete your first race to unlock this prize!</p>
                @else
                    <p class="text-green-500">This prize is unlocked!</p>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
