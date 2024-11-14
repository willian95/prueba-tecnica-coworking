<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationsRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CreateReservationsController extends Controller
{
    public function store(CreateReservationsRequest $request){

        $time = $request->time;
        $time = $time < 10 ? "0".$time : $time;
        $dateTimestamp = $request->date." ".$time.":00";

        if(Reservation::where("room_id", $request->room)->where('status', '<>', Reservation::REJECTED)->where("timestamp", $dateTimestamp)->exists())
        return redirect()->route('user.rooms.list')->with("error", "Date and time not available for this room");

        $reservation = new Reservation();
        $reservation->room_id = $request->room;
        $reservation->user_id = $request->user()->id;
        $reservation->timestamp = $dateTimestamp;
        $reservation->save();

        return redirect()->route('user.rooms.list')->with("success", "Reservation created");

    }


}
