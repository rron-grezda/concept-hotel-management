<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/country/{id}/cities', function($id){
    return App\Models\City::where('country_id', $id)->get()->toArray();
})->name('get-cities');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/search', [WelcomeController::class, 'search'])->name('search');
Route::get('/hotel/{id}/details', [WelcomeController::class, 'getHotelDetails'])->name('hotel-details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post("/book", [BookController::class, 'book'])->name('book-room');
Route::get("/bookings", [BookController::class, 'bookings'])->name('bookings');
Route::get("/booking/{id}/delete", [BookController::class, 'delete'])->name('booking.delete');

Route::resource('hotels', HotelController::class);
Route::resource('rooms', RoomController::class);
Route::resource('users', UserController::class)->only(['index', 'destroy']);

require __DIR__.'/auth.php';
