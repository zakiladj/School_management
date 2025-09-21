<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/about',function(){
    return view('about');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

// User management routes
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    // Add other user management routes here, e.g., create, edit, delete
    Route::get('/create', [UserController::class, 'UserCreate'])->name('user.create');
    Route::get('/information', [UserController::class, 'UserInformation'])->name('user.information');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');
    Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');



});

// Profile management routes
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('/viewprofile/{id}', [ProfileController::class, 'ProfileIdView'])->name('profileId.view');

    Route::get('/edit', [UserController::class, 'ProfileEdit'])->name('profile.edit');
    Route::get('/password_edit', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/ps_update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');



    // Route::post('/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    // Route::get('/password/view', [UserController::class, 'PasswordView'])->name('password.view');
    // Route::post('/password/update', [UserController::class, 'PasswordUpdate'])->name('password.update');
});


