<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomReservationsController extends Controller
{
    public function show($room){

        $room = Room::find($room);
        $reservations = Reservation::where("room_id", $room->id)->with("user")->get();

        return view('admin.reservations.index', [
            "reservations" => $reservations,
            "room" => $room
        ]);
    }
}
