<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\views\demandes\index;
use App\resources\views;
use App\Http\Controllers\AdminController;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/demandes/index', [AdminController::class, 'demandes'])->name('demandes.index');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/mac', [DemandeController::class, 'index']);
Route::post('/post', [DemandeController::class, 'store'])->name("demande.store");
Route::get('/demandes/create', [DemandeController::class, 'create']);
Route::post('/demandes', [DemandeController::class, 'store']);
Route::delete('/demandes/{id}', [DemandeController::class, 'destroy']);
Route::get('/demandes/{demande}/edit', [DemandeController::class, 'edit']);
Route::patch('/demandes/{id}', [DemandeController::class, 'update']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'user'])->name('user.dashboard');
});

Route::get('/test', function () {
    $users = User::where("id", 1)->get();
    return $users;
});

Route::middleware(['auth'])->group(function () {
    Route::post('/admin/save', [AdminController::class, 'save'])->name('admin.save');
});

Route::get('/welcome', function () {
    return view('login');
})->name('welcome');


Route::post('/admin/process-request/{id}', [AdminController::class, 'processRequest'])->name('admin.process_request.post');