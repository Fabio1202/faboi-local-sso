<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/permissions', function() {
       $user = request()->user();
       $clientID = request()->get('client_id');
       $client = \App\Models\Client::find($clientID);
       $application = $client->application;
       $permissions = $user->permissions($application);
    });
});

Route::group(['middleware' => 'client'], function() {
    Route::post('permission-groups', [\App\Http\Controllers\Api\PermissionGroupController::class, 'store']);
});
