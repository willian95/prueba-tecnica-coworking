<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reservar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <div class="container">

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Elige una hora del día</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <select name="time-selector" class="form-control" id="time-selector">
                                        <option value="0">12am</option>
                                        <option value="1">1am</option>
                                        <option value="2">2am</option>
                                        <option value="3">3am</option>
                                        <option value="4">4am</option>
                                        <option value="5">5am</option>
                                        <option value="6">6am</option>
                                        <option value="7">7am</option>
                                        <option value="8">8am</option>
                                        <option value="9">9am</option>
                                        <option value="10">10am</option>
                                        <option value="11">11am</option>
                                        <option value="12">12pm</option>
                                        <option value="13">1pm</option>
                                        <option value="14">2pm</option>
                                        <option value="15">3pm</option>
                                        <option value="16">4pm</option>
                                        <option value="17">5pm</option>
                                        <option value="18">6pm</option>
                                        <option value="19">7pm</option>
                                        <option value="20">8pm</option>
                                        <option value="21">9pm</option>
                                        <option value="22">10pm</option>
                                        <option value="23">11pm</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="verifyTimeDate()">Reservar</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('user.reservations.store') }}" method="post" id="reservationForm">
                            @csrf
                            <input type="hidden" name="date" id="date" />
                            <input type="hidden" name="time" id="time" />
                            <input type="hidden" name="room" value="{{$room}}" />
                        </form>


                        <div id="calendar"></div>

                    </div>
                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>

<script>
    let choosenDate = null
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            validRange: {
                start: "{{date('Y-m-d')}}"
            },
            dateClick: function(date) {
                choosenDate = date
                var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
                myModal.toggle()
            }
        });
        calendar.render();
    });

    verifyTimeDate = () => {

        const choosenHour = document.getElementById("time-selector").value
        const date = new Date();
        const month = date.getMonth()+1;
        const day = date.getDate() < 10 ? `0${date.getDate()}` : date.getDate();
        const year = date.getFullYear();
        const hour = date.getHours()

        const currentDateTime = Date.now()
        
        if(choosenDate.dateStr == `${year}-${month}-${day}`){

            if(choosenHour <= hour){
                alert("Debes elegir una hora mayor a la actual")
                return 
            }

        }

        document.getElementById("date").value = choosenDate.dateStr
        document.getElementById("time").value = choosenHour

        const reservationForm = document.getElementById('reservationForm')
        reservationForm.submit()


    }

</script>