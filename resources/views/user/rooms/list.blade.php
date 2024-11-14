<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Salas
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
                                    <th>Titulo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $room->title }}</td>
                                        <td>
                                            <a href="{!! route('user.rooms.reserve', ['room'=>$room->id]) !!}" class="btn btn-primary">Reservar</a>
                                        </td>
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