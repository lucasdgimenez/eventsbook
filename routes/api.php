<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FeedEventController;
use App\Http\Controllers\EventActionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/ping', function() {
    return ['pong'=>true];
});

Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/user', [AuthController::class, 'create']);

Route::get('/search', [SearchController::class, 'search']);

Route::get('/feedEvents', [FeedEventController::class, 'read']);
Route::get('/feedEvents/{id}/', [FeedEventController::class, 'eventItem']);

Route::post('/feed', [FeedEventController::class, 'create']);

Route::post('/feedAction/{nameAction}/{action}/{id}', [EventActionController::class, 'eventAction']);
/*Route::post('/feedAction/EventWillGo/{action}/{id}', [EventActionController::class, 'eventAction']);*/

/*Route::post('/feedAction/EventInterestList/{action}', [EventActionController::class, 'action'])
Route::post('/feedAction/EventInterestList/{action}', [EventActionController::class, 'action'])
Route::post('/feedAction/EventInterestList/{action}', [EventActionController::class, 'action'])*/

