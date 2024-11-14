<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class MyReservationsController extends Controller
{
    public function index(Request $request){

        $reservations = Reservation::where("user_id", $request->user()->id)->with("room")->get();

        return view('user.reservations.index', [
            "reservations" => $reservations
        ]);

    }
}
