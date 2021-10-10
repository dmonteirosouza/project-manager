<?php

use App\Api\Project\Controllers\ProjectController;
use App\Api\Task\Controllers\TaskController;
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

Route::prefix('projects')->name('api.projects.')->group(function() {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::post('/', [ProjectController::class, 'store'])->name('store');
    Route::delete('/{project_id}', [ProjectController::class, 'destroy'])->name('destroy');

    Route::prefix('{project_id}/tasks')->name('tasks.')->group(function() {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::put('/{task_id}', [TaskController::class, 'update'])->name('update');
    });
});
