<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    public const REJECTED = 'rejected';
    public const ACCEPTED = 'accepted';
    public const PENDING = 'pending';

    use HasFactory;

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
