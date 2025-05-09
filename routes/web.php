<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/debug-user', function () {
//     dd(Auth::user());
// });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Route::post('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');
    // Route::get('users/lang',)
    // Route::get('/users/lang', function () {
    //     return view('navigation');
    // })->name('users.lang');
    
    Route::get('lang', [LanguageController::class, 'change'])->name("change.lang");
    
});

require __DIR__.'/auth.php';
