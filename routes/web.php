<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource ('users','App\Http\Controllers\UsersController')->middleware('auth');
Route::resource ('visitors','App\Http\Controllers\VisitorsController')->middleware('auth');
Route::get('/visitors/{id}/index', 'App\Http\Controllers\EquipmentController@index')->name('visitorsEquipment');
Route::post('/visitors/{id}/guardar', 'App\Http\Controllers\EquipmentController@store')->name('saveEquipment');
Route::post('/visitors/{id}/guardarEquipo', 'App\Http\Controllers\MovementController@store')->name('saveMovement');
Route::get('visitors/ocultar/{id}', 'App\Http\Controllers\EquipmentController@ocultar');
Route::get('/visitors/{id}/equipment', 'App\Http\Controllers\MovementController@index')->name('movementEquipment');
Route::get('movement/ocultar/{id}', 'App\Http\Controllers\MovementController@ocultar');
Route::get('equipment/QR/{id}', 'App\Http\Controllers\EquipmentController@generateQR');

require __DIR__.'/auth.php';
