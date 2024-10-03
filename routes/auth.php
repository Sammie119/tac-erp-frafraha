<?php

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:'.RolesEnum::USERSMANAGER->value]], function () {
        Route::get('users', [RegisteredUserController::class, 'index'])->name('users')->middleware('permission:'.PermissionsEnum::VIEWUSERS->value);
        Route::post('register', [RegisteredUserController::class, 'store'])->middleware('permission:'.PermissionsEnum::CREATEUSERS->value);;
        Route::put('register', [RegisteredUserController::class, 'update'])->middleware('permission:'.PermissionsEnum::UPDATEUSERS->value);;
        Route::post('user_roles', [RegisteredUserController::class, 'userRoles'])->middleware('permission:'.PermissionsEnum::ADDROLESTOUSERS->value);;
        Route::post('delete_user', [RegisteredUserController::class, 'destroy'])->middleware('permission:'.PermissionsEnum::DELETEUSERS->value);;
    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

//Route::group(['middleware' => ['role:manager|writer']], function () { ... });
//Route::group(['middleware' => ['permission:publish articles|edit articles']], function () { ... });
