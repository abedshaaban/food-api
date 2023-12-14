<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/food',  [PublicController::class, 'get_public_food']);

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
    Route::post('/user/address/delete-all', 'delete_all_addresses');
    Route::post('/user/address/update/{id}', 'update_address_by_id');

});

Route::middleware(['auth:api', 'seller.check'])->group(function () {
    Route::post('/seller/food/create',  [FoodController::class, 'create_food']);
    Route::post('/seller/food/get',  [FoodController::class, 'get_all_food']);
    Route::post('/seller/food/delete-item',  [FoodController::class, 'delete_food_by_id']);
    Route::post('/seller/food/delete-all',  [FoodController::class, 'delete_all_food']);
    Route::post('/seller/food/update',  [FoodController::class, 'update_food_by_id']);

});
