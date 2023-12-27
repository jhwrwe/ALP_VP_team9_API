<?php

use App\Http\Controllers\Api\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todolist/{urgency}', [TodolistController::class, 'todolist']);
Route::get('todolistDetail/{id}', [TodolistController::class, 'todolistDetail']);
Route::get('lateTodolists', [TodolistController::class, 'showLateTodolists']);
Route::get('todayTodolists', [TodolistController::class, 'showTodayTodolists']);
Route::get('tomorrowTodolists', [TodolistController::class, 'showTomorrowTodolists']);
Route::get('somedayTodolists', [TodolistController::class, 'showSomedayTodolists']);
Route::get('doneTodolists', [TodolistController::class, 'showDoneTodolists']);