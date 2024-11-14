<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis reservas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <div class="container">

                        <table class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sala</th>
                                    <th>Fecha y hora</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $reservation->room->title }}</td>
                                        <td>{{ $reservation->timestamp }}</td>
                                        <td>{{ $reservation->status }}</td>
                                    </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>