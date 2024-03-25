<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallsController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\SessionController;
use App\Models\Hall;
use App\Models\Film;

// Route::post('/admin', function () {
//     dd(Hall::all());
// })->name('admin');

Route::get('/',[HallsController::class, 'indexClient'])->name('client');
Route::get('/hall/{id}',[SessionController::class, 'index'])->name('bookingHall');
Route::post('/payment/update',[SessionController::class, 'updateSession']);
Route::get('/payment',[SessionController::class, 'payment'])->name('payment');
Route::get('/ticket',[SessionController::class, 'ticket'])->name('ticket');

Auth::routes();
Route::group(['middleware' => 'auth:sanctum'], function () {
Route::get('/admin',[HallsController::class, 'index'])->name('admin');
Route::post('/admin/addhall',[HallsController::class, 'addHall'])->name('addHall');
Route::get('/admin/delete/{id}',[HallsController::class, 'deleteHall'])->name('deleteHall');
Route::get('/price',[HallsController::class, 'price']);
Route::post('/price/update',[HallsController::class, 'updatePrice']);
Route::post('/config/update',[HallsController::class, 'updateConfig']);
Route::post('/admin/addfilm',[FilmsController::class, 'addFilm'])->name('addFilm');
Route::get('/admin/deletefilm/{id}',[FilmsController::class, 'deleteFilm'])->name('deleteFilm');
Route::post('/admin/addsession',[SessionController::class, 'addSession'])->name('addSession');
Route::get('/admin/deletesession/{id}',[SessionController::class, 'deleteSession'])->name('deleteSession');
Route::post('/admin/startsale',[HallsController::class, 'startSale'])->name('startSale');
});