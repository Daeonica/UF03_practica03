<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.events');
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/store', [EventController::class, 'store'])->name('events.store');
    Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
    Route::get('/show', [EventController::class, 'show'])->name('events.show');
    Route::get('/{id}/register', [EventController::class, 'register'])->name('events.register');
    Route::post('/{id}/attendees', [EventController::class, 'storeAttendee'])->name('events.storeAttendee');
    Route::get('/{id}/attendees', [EventController::class, 'showAttendees'])->name('events.showAttendees');
    Route::delete('/{id}/attendees/{attendeeId}', [EventController::class, 'destroyAttendee'])->name('events.destroyAttendee');

});



