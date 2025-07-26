<?php

use App\Http\Controllers\RiasecTestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/register', function () {
    return view('auth.register');
})->name('register'); 

Route::get('/login', function () {
    return view('auth.login');
})->name('login'); 

Route::get('/riasec-test', [RiasecTestController::class, 'index'])->name('riasec.test');
Route::get('/riasec-result', [RiasecTestController::class, 'showResult'])->name('riasec.result');

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

Route::get('/about', function () {
    return view('about');
})->name('about');

