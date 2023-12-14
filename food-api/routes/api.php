<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(UserController::class)->group(function () {
    Route::post('/user/get', 'get_user_by_token');
    Route::post('/user/update-profile', 'update_profile');

});

Route::controller(AddressController::class)->group(function () {
    Route::post('/user/address/create', 'create_address');
    Route::post('/user/address/get', 'get_addresses');
    Route::post('/user/address/delete/{id}', 'delete_address_by_id');

});
