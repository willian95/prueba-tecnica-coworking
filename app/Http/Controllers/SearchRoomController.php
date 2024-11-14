<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class SearchRoomController extends Controller
{
    public function search(Request $request){

        $rooms = Room::where("title", "like", '%'.$request->searchQuery.'%')->get();
        return view('admin.rooms.list', [
            "rooms" => $rooms
        ]);

    }
}
