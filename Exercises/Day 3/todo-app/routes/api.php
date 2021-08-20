<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', [TaskController::class, 'getTasks']);
Route::post('/tasks', [TaskController::class, 'createTask']);
Route::get('/tasks/{id}', [TaskController::class, 'getTaskById']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTaskById']);
Route::patch('/tasks/{id}', [TaskController::class, 'updateTaskStatus']);
