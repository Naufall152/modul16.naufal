<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;



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

Route::get('/local-disk', function () {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
    return asset('storage/local-example.txt');
});

Route::get('/public-disk', function () {
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

Route::get('/retrieve-local-file', function () {
    if (Storage::disk('local')->exists('local-example.txt')) {
        $contents = Storage::disk('local')->get('local-example.txt');
    } else {
        $contents = 'File does not exist';
    }
    return $contents;
});

Route::get('/retrieve-public-file', function () {
    if (Storage::disk('public')->exists('public-example.txt')) {
        $contents = Storage::disk('public')->get('public-example.txt');
    } else {
        $contents = 'File does not exist';
    }
    return $contents;
});

Route::get('/download-local-file', function () {
    return Storage::download('local-example.txt', 'local file');
});

Route::get('/download-public-file', function () {
    return Storage::download('public/public-example.txt', 'public file');
});

//path,size

Route::get('/file-url', function () {
    // Just prepend "/storage" to the given path and return a relative URL
    $url = Storage::url('local-example.txt');
    return $url;
});

Route::get('/file-size', function () {
    $size = Storage::size('local-example.txt');
    return $size;
});

Route::get('/file-path', function () {
    $path = Storage::path('local-example.txt');
    return $path;
});

//menyimpan

Route::get('/upload-example', function () {
    return view('upload_example');
});

Route::post('/upload-example', function (Request $request) {
    $path = $request->file('avatar')->store('public');
    return $path;
})->name('upload-example');

// menghapus

Route::get('/delete-local-file', function (Request $request) {
    Storage::disk('local')->delete('local-example.txt');
    return 'Deleted';
});
Route::get('/delete-public-file', function (Request $request) {
    return 'Deleted';
});

//download file employee
Route::get('download-file/{employeeId}', [EmployeeController::class,
'downloadFile'])->name('employees.downloadFile');

