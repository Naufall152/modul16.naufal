<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;


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

 Route::get('/', function () {
     return view('login');
});


// routes/web.php
Route::get('/home', function () {
    return view('home', ['pageTitle' => 'Home']);
})->name('home')->middleware('auth');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('profile', ProfileController::class)->name('profile');

Route::resource('employees', EmployeeController::class);

Route::get('/local-disk', function() {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
return asset('storage/local-example.txt');
});

Route::get('/public-disk', function() {
    Storage::disk('public')->put('public-example.txt', 'This is public example
content');
return asset('storage/public-example.txt');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/create', [HomeController::class, 'index'])->name('create')->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

