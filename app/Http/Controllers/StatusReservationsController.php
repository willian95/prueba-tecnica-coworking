<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class StatusReservationsController extends Controller
{
    public function update(Request $request){

        $reservation = Reservation::find($request->reservation);
        $reservation->status = $request->status;
        $reservation->update();

        return redirect()->back()->with('success', 'Reservation status updated');

    }
}
