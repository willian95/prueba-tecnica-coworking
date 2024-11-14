<?php

use App\Http\Controllers\AllReservationsController;
use App\Http\Controllers\CreateReservationsController;
use App\Http\Controllers\CreateRoomsController;
use App\Http\Controllers\DeleteRoomController;
use App\Http\Controllers\IndexRoomsController;
use App\Http\Controllers\MyReservationsController;
use App\Http\Controllers\RoomReservationsController;
use App\Http\Controllers\SearchRoomController;
use App\Http\Controllers\StatusReservationsController;
use App\Http\Controllers\UpdateRoomsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified', 'onlyUser'])->prefix('user')->name("user.")->group(function() {

    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::prefix('rooms')->name('rooms.')->group(function() {
        Route::get('/', [IndexRoomsController::class, 'index'])->name('list');
        Route::get('/reserve/{room}', function ($room) {
            return view('user.rooms.reserve', ["room" => $room]);
        })->name('reserve');
    });

    Route::prefix('reservations')->name('reservations.')->group(function() {
        Route::post('/', [CreateReservationsController::class, 'store'])->name('store');
        Route::get('/', [MyReservationsController::class, 'index'])->name('index');
    });


});


Route::middleware(['auth', 'verified', 'onlyAdmin'])->prefix('admin')->name("admin.")->group(function() {

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('rooms')->name('rooms.')->group(function() {
        Route::get('/', [IndexRoomsController::class, 'index'])->name('list');

        Route::get('/create', function () {
            return view('admin.rooms.create');
        })->middleware(['auth', 'verified', 'onlyAdmin'])->name('create');

        Route::get('/store', [CreateRoomsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UpdateRoomsController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [UpdateRoomsController::class, 'update'])->name('update');
        Route::get('/search', [SearchRoomController::class, 'search'])->name('search');
        Route::delete('/delete/{id}', [DeleteRoomController::class, 'delete'])->name('delete');
    });

    Route::prefix('reservations')->name('reservations.')->group(function() {
        Route::get('/{room}', [RoomReservationsController::class, 'show'])->name('index');
        Route::post('/', [StatusReservationsController::class, 'update'])->name('update');
        Route::get('/', [AllReservationsController::class, 'listReservations'])->name('list');

    });

});

require __DIR__.'/auth.php';
