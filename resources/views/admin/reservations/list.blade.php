<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <div class="container">
                        
                        <form action="{{ route('admin.reservations.list') }}">
                        @csrf
                            <label for="">Salas</label>
                            <div  class="d-flex w-25">
                                <select class="form-control" name="room">
                                    <option value="-">Todas</option>
                                    @foreach($rooms as $room)
                                        <option 
                                            @if($selectedRoom == $room->id)
                                                selected
                                            @endif
                                            value="{{$room->id}}">{{ $room->title }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Filtrar</button>
                            </div>
                        </form>

                        <table class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Sala</th>
                                    <th>Fecha y hora</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->user->email }}</td>
                                        <td>{{ $reservation->room->title }}</td>
                                        <td>{{ $reservation->timestamp }}</td>
                                        <td>{{ $reservation->status }}</td>
                                        <td>
                                            @if($reservation->status == 'pending')
                                                <button onclick="openModal('{{$reservation->id}}')" class="btn btn-secondary">Cambiar status</button>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Elige una hora del día</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="status-selector" class="form-control" id="status-selector">
                            <option value="accepted">Aceptar</option>
                            <option value="rejected">Rechazar</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="updateStatus()">Actualizar</button>
                    </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.reservations.update') }}" method="post" id="reservationForm">
                @csrf
                <input type="hidden" name="reservation" id="reservation" />
                <input type="hidden" name="status" id="status" />
            </form>

            
        </div>
    </div>
</x-app-layout>

<script>

    let reservationToChange = null

    const openModal = (id) => {

        reservationToChange = id
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.toggle()

    }

    const updateStatus = () => {
        
        const reservationForm = document.getElementById("reservationForm")
        const status = document.getElementById("status-selector").value
        document.getElementById("reservation").value = reservationToChange
        document.getElementById("status").value = status

        reservationForm.submit()

    }



</script>