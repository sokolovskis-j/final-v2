<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BlogController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blogs/add', [BlogController::class, 'add'])->name('blog.add');
    Route::post('/blogs/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'delete'])->name('blog.delete');



});

require __DIR__.'/auth.php';
