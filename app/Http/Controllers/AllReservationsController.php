<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class AllReservationsController extends Controller
{
    public function listReservations(Request $request){

        $rooms = Room::all();
        $reservationsQuery = Reservation::with("room")->with("user");

        if($request->has('room') && $request->room != '-'){
            $reservationsQuery->where("room_id", $request->room);
        }

        $reservations = $reservationsQuery->get();

        return view('admin.reservations.list', [
            "reservations" => $reservations,
            "rooms" => $rooms,
            "selectedRoom" => $request->has('room') ? $request->room : ""
        ]);

    }
}
