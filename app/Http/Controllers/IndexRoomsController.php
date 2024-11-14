<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class IndexRoomsController extends Controller
{
    public function index(Request $request){
        $rooms = Room::all();
        

        if($request->user()->role == 'user'){
            return view('user.rooms.list', [
                "rooms" => $rooms
            ]);
        }

        return view('admin.rooms.list', [
            "rooms" => $rooms
        ]);
    }
}
