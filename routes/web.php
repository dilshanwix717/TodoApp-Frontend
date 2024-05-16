<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

//Home
Route::get('/home', [HomeController::class, "index"])->name('dashboard');

//Todo
Route::prefix('/todo')->group(function () {
    Route::get('/', [TodoController::class, "index"])->name('todo')->middleware('auth');
    Route::post('/store', [TodoController::class, "store"])->name('todo.store')->middleware('auth');
    Route::get('/list', [TodoController::class, "list"])->name('todo.list')->middleware('auth');
    Route::get('/{task_id}/get', [TodoController::class, "get"])->name('todo.get')->middleware('auth');
    Route::delete('/{task_id}/delete', [TodoController::class, "delete"])->name('todo.delete')->middleware('auth');
    Route::get('/{task_id}/done', [TodoController::class, "done"])->name('todo.done')->middleware('auth');
    Route::get('/edit', [TodoController::class, "edit"])->name('todo.edit')->middleware('auth');
    Route::post('/{task_id}/update', [TodoController::class, "update"])->name('todo.update')->middleware('auth');
    Route::get('/{task_id}/sub', [TodoController::class, "sub"])->name('todo.sub')->middleware('auth');
    Route::post('/sub/store', [TodoController::class, "subStore"])->name('todo.sub.store')->middleware('auth');
});

require __DIR__ . '/auth.php';
