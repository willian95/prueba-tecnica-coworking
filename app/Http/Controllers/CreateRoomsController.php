<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomsRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class CreateRoomsController extends Controller
{

    public function store(CreateRoomsRequest $request){

        $room = new Room();
        $room->title = $request->title;
        $room->description = $request->description;
        $room->save();

        return redirect()->back()->with('success', 'Room created successfully');

    }   

}
