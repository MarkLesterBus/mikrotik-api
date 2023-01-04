<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\IPController;
use App\Http\Controllers\HotspotController;
use App\Http\Controllers\QueuesController;
use App\Http\Controllers\InterfaceController;
use App\Http\Controllers\VoucherController;

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


Route::get('/system/{uuid}/interfaces', [InterfaceController::class, 'interfaces']);

Route::get('/system/{uuid}/hotspot', [HotspotController::class, 'hotspot']);
Route::post('/system/{uuid}/hotspot', [HotspotController::class, 'add_hotspot']);
Route::delete('/system/{uuid}/hotspot/{id}', [HotspotController::class, 'remove_hotspot']);

Route::get('/system/{uuid}/hotspot/profiles', [HotspotController::class, 'profile']);
Route::post('/system/{uuid}/hotspot/profiles', [HotspotController::class, 'add_profile']);
Route::delete('/system/{uuid}/hotspot/profiles/{id}', [HotspotController::class, 'remove_profile']);


Route::get('/system/{uuid}/queues/simple', [QueuesController::class, 'simple_queues']);
Route::get('/system/{uuid}/queues/tree', [QueuesController::class, 'queue_tree']);


Route::get('/system/{uuid}/ip/addresses', [IPController::class, 'address_list']);
Route::post('/system/{uuid}/ip/addresses', [IPController::class, 'add_address']);
Route::delete('/system/{uuid}/ip/addresses/{id}', [IPController::class, 'remove_address']);

Route::get('/system/{uuid}/ip/pool', [IPController::class, 'pool']);
Route::post('/system/{uuid}/ip/pool', [IPController::class, 'add_pool']);
Route::delete('/system/{uuid}/ip/pool/{id}', [IPController::class, 'remove_pool']);

Route::get('/system/{uuid}/ip/dns', [IPController::class, 'dns']);

Route::get('/system/{uuid}/bridges', [InterfaceController::class, 'bridges']);
Route::post('/system/{uuid}/bridges', [InterfaceController::class, 'add_bridge']);
Route::delete('/system/{uuid}/bridges/{id}', [InterfaceController::class, 'remove_bridge']);

Route::get('/system/{uuid}/ports', [InterfaceController::class, 'ports']);
Route::post('/system/{uuid}/ports', [InterfaceController::class, 'add_port']);
Route::delete('/system/{uuid}/ports/{id}', [InterfaceController::class, 'remove_port']);


Route::get('/system/{uuid}/vlans', [InterfaceController::class, 'vlans']);
Route::post('/system/{uuid}/vlans', [InterfaceController::class, 'add_vlan']);
Route::delete('/system/{uuid}/vlans/{id}', [InterfaceController::class, 'remove_vlan']);


Route::get('/system/{uuid}/hotspot/users', [VoucherController::class, 'users']);
Route::post('/system/{uuid}/hotspot/users', [VoucherController::class, 'add_user']);
Route::delete('/system/{uuid}/hotspot/users/{id}', [VoucherController::class, 'remove_user']);

Route::get('/system/{uuid}/hotspot/users/profile', [VoucherController::class, 'user_profile']);
Route::post('/system/{uuid}/hotspot/users/profile', [VoucherController::class, 'add_user_profile']);
Route::delete('/system/{uuid}/hotspot/users/profile/{id}', [VoucherController::class, 'remove_user_profile']);
