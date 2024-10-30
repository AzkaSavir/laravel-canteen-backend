<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ini semua adalah route biar bisa di jalankan saat di panggil di tempat lain

Route::get('/', function () {
    return view('pages.auth.login');
});

// pindahin ke fortifyserviceprovider

Route::get('home', function () {
    return view('pages.dashboard');
// ->name('login); adalah untuk namain dan nampilin apa aja yang ada di route
});

Route::resource('user', UserController::class);
// Route::get('/register', function () {
//     return view('pages.auth.register');
// })->name('register');

// commandan untuk nampilin route adalah php artisan route:list