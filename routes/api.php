<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\IPController;
use App\Http\Controllers\HotspotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('/routers', RouterController::class);
Route::get('/system/{uuid}', [SystemController::class, 'system']);
Route::get('/system/{uuid}/logs', [SystemController::class, 'logs']);
Route::get('/system/{uuid}/resources', [SystemController::class, 'resources']);
Route::get('/system/{uuid}/traffic/{interface}', [SystemController::class, 'monitor']);


Route::get('/system/{uuid}/interfaces', [SystemController::class, 'interfaces']);
Route::get('/system/{uuid}/hotspot', [HotspotController::class, 'hotspot']);
Route::get('/system/{uuid}/hotspot/profiles', [HotspotController::class, 'profile']);


Route::get('/system/{uuid}/ip/addresses', [IPController::class, 'address_list']);
Route::post('/system/{uuid}/ip/addresses', [IPController::class, 'add_address']);
Route::delete('/system/{uuid}/ip/addresses/{id}', [IPController::class, 'remove_address']);

Route::get('/system/{uuid}/ip/pool', [IPController::class, 'pool']);
Route::post('/system/{uuid}/ip/pool', [IPController::class, 'add_pool']);
Route::delete('/system/{uuid}/ip/pool/{id}', [IPController::class, 'remove_pool']);

Route::get('/system/{uuid}/ip/dns', [IPController::class, 'dns']);

Route::get('/system/{uuid}/bridges', [SystemController::class, 'bridges']);
Route::post('/system/{uuid}/bridges', [SystemController::class, 'add_bridge']);
Route::delete('/system/{uuid}/bridges/{id}', [SystemController::class, 'remove_bridge']);

Route::get('/system/{uuid}/ports', [SystemController::class, 'ports']);
Route::post('/system/{uuid}/ports', [SystemController::class, 'add_port']);
Route::delete('/system/{uuid}/ports/{id}', [SystemController::class, 'remove_port']);


Route::get('/system/{uuid}/vlans', [SystemController::class, 'vlans']);
Route::post('/system/{uuid}/vlans', [SystemController::class, 'add_vlan']);
Route::delete('/system/{uuid}/vlans/{id}', [SystemController::class, 'remove_vlan']);
