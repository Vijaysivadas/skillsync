<?php

use App\Http\Controllers\auth\AuthManageController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RecruiterAuth;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", [AuthManageController::class, "login"])->name("login");
Route::post("/login", [AuthManageController::class, "loginPost"])->name("login.post");
Route::get("/register", [AuthManageController::class, "register"])->name("register");
Route::post("/register", [AuthManageController::class, "registerPost"])->name("register.post");

Route::group(['middleware' => ['auth', UserAuth::class]], function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/user/profilesetup', [UserController::class, 'profileSetup'])->name('user.profileSetup');
});

Route::group(['middleware' => ['auth', RecruiterAuth::class]], function () {
    Route::get('/recruiter/dashboard', [RecruiterController::class, 'dashboard'])->name('recruiter.dashboard');
    Route::post('/recruiter/requirements', [RecruiterController::class, 'requirements'])->name('recruiter.requirements');
    Route::get('/recruiters/select/{category}', [RecruiterController::class, 'select'])->name('recruiters.select');


});
