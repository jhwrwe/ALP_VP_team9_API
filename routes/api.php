z<?php

use App\Http\Controllers\Api\TodolistController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BadgesUserController;
use App\Http\Controllers\Api\BadgesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MissionController;
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
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::get('check_password', [UserController::class, 'checkPassword']);
        Route::get('all_user', [UserController::class, 'getAllUser']);
        Route::patch('update_user', [UserController::class, 'updateUser']);
        Route::delete('delete_user', [UserController::class, 'deleteUser']);

        Route::post('create_badge', [BadgesController::class, 'createBadge']);
        Route::delete('delete_badge', [BadgesController::class, 'deletedbadge']);
        Route::get('see_All_Badges', [BadgesController::class, 'seeBadge']);

        Route::post('create_badge_user/{id}', [BadgesUserController::class, 'CreateUserBadge']);
        Route::delete('delete_badge_user', [BadgesUserController::class, 'DeleteBadgeUser']);
        Route::put('coins_minus/{id}', [BadgesUserController::class, 'substractcoins']);
        Route::get('see_all_badge', [BadgesUserController::class, 'seeAllUserBadge']);

        Route::get('todolist/{urgency}', [TodolistController::class, 'todolist']);
        Route::get('todolist/', [TodolistController::class, 'allTodolist']);
        Route::get('todolistDetail/{id}', [TodolistController::class, 'todolistDetail']);
        Route::get('lateTodolists', [TodolistController::class, 'showLateTodolists']);
        Route::get('todayTodolists', [TodolistController::class, 'showTodayTodolists']);
        Route::get('tomorrowTodolists', [TodolistController::class, 'showTomorrowTodolists']);
        Route::get('somedayTodolists', [TodolistController::class, 'showSomedayTodolists']);
        Route::get('doneTodolists', [TodolistController::class, 'showDoneTodolists']);
        Route::post('todolist', [TodolistController::class, 'storeTodolist']);
        Route::patch('todolist/{id}', [TodolistController::class, 'updateTodolist']);
        Route::delete('todolist/{id}', [TodolistController::class, 'deleteTodolist']);
        Route::patch('todolistDone/{id}', [TodolistController::class, 'todolistDone']);

        Route::post('mission', [MissionController::class, 'storeMission']);
        Route::get('mission', [MissionController::class, 'getAllMission']);
        Route::delete('mission/{id}', [MissionController::class, 'deleteMission']);
        Route::patch('claimMissionCoin/{id}', [MissionController::class, 'claimMissionCoin']);
    }
);



Route::post('create_user', [UserController::class, 'createUser']);



