<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class DeleteRoomController extends Controller
{
    public function delete($id){

        $room = Room::find($id);
        
        $message = $room->count() > 0 ? 'Room deleted' : 'Room not found';

        $room->delete();

        return redirect()->route('admin.rooms.list')->with('success', $message);

    }
}
