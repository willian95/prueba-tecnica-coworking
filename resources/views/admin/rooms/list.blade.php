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
                
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex">
                                <div>
                                    
                                    <x-text-input id="query" class="block mt-1 w-full"
                                                    type="text"
                                                    name="query"
                                                    />
                                    
                                    @foreach($errors->get('query') as $message)
                                        <p class="error fs-6 text-danger">{{__($message)}}</p>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" onclick="search()">Buscar</button>
                            </div>

                            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">Agregar Nuevo</a>
                        </div>

                        <table class="table mt-4" style="width: 100%">
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
                                            <a href="{!! route('admin.rooms.edit', ['id'=>$room->id]) !!}" class="btn btn-primary">Editar</a>
                                            <a href="{!! route('admin.reservations.index', ['room'=>$room->id]) !!}" class="btn btn-success">Reservas</a>
                                            <button onclick="remove('{{$room->id}}')" class="btn btn-secondary">Eliminar</button>
                                            <form action="{!!route('admin.rooms.delete', ['id'=>$room->id])!!}" method="POST" id="delete-room-{{$room->id}}">
                                                @csrf
                                                @method('delete')
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
    </div>
</x-app-layout>

<script>

    const search = () => {
        const query = document.getElementById("query").value
        window.location.href="{{ route('admin.rooms.search') }}?searchQuery="+query
    }

    const remove = (id) => {
       
        Swal.fire({
            title: "¿Deseas eliminar esta sala junto a sus reservaciones?",
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            cancelButtonText:"Cancelar"
        }).then((result) => {
            
            if (result.isConfirmed) {
                const form = document.getElementById('delete-room-'+id)
                form.submit()
            }
        });
    }   

</script>
