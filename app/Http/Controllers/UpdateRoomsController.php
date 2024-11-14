<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRoomsRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class UpdateRoomsController extends Controller
{
    public function update(UpdateRoomsRequest $request){

        $room = Room::find($request->id);
        $room->title = $request->title;
        $room->description = $request->description;
        $room->update();

        return redirect()->back()->with('success', "Room updated");

    }

    public function edit(Request $request){

        $room = Room::find($request->id);

        return view('admin.rooms.edit', ["room" => $room]);

    }
}
