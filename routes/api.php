<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryServicesController;
use App\Http\Controllers\OpinionsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RequestBidsController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\UserOpinionsController;
use App\Http\Controllers\UserRequestsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ValidateSupplierRegisterController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::post('/sanctum/token', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [RegisterController::class, 'register'])->name('api.register');
Route::post('/upload', UploadImageController::class)->name('api.upload');
Orion::resource('services', ServicesController::class);
Orion::resource('categories', CategoriesController::class);
Route::post('/register/validate', ValidateSupplierRegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');
    Route::post('/profile', [AuthController::class, 'profile'])->name('api.profile');
    Orion::hasManyResource('categories', 'services', CategoryServicesController::class);
    Orion::hasManyResource('services', 'requests', ServiceRequestController::class);
    Orion::hasManyResource('users', 'requests', UserRequestsController::class);
    Orion::hasManyResource('users', 'opinions', UserOpinionsController::class);
    Orion::resource('requests', RequestsController::class);
    Orion::hasManyResource('requests', 'bids', RequestBidsController::class);
    Orion::resource('bids', BidsController::class);
    Orion::resource('users', UsersController::class);
    Orion::resource('opinions', OpinionsController::class);
    Orion::resource('orders', OrdersController::class);
});
