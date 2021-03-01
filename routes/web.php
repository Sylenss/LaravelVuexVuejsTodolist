<?php

use App\Http\Controllers\TasksController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->prefix('api')->group(function () {
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::get('/tasks?page=', [TasksController::class, 'page']);
    Route::post('/tasks', [TasksController::class, 'create']);
    Route::post('/tasks/{task}/complete', [TasksController::class, 'complete']);
    Route::post('/tasks/{task}', [TasksController::class, 'update']);
    Route::delete('/tasks/{task}', [TasksController::class, 'delete']);
});

require __DIR__ . '/auth.php';