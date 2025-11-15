<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Owner\ShopController as OwnerShopController;
use App\http\Controllers\Owner\ServiceController as OwnerServiceController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops_index');
Route::get('/workshops/{slug}', [WorkshopController::class, 'show'])->name('workshops_show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/shops' , [OwnerShopController::class, 'index'])->name('owner_workshops_index');
    Route::get('/dashboard/shops/create' , [OwnerShopController::class, 'create'])->name('owner_workshops_create');
    Route::post('/dashboard/shops' , [OwnerShopController::class, 'store'])->name('owner_workshops_store');
    Route::get('/dashboard/shops/{id}/edit' , [OwnerShopController::class, 'edit'])->name('owner_workshops_edit');
    Route::put('/dashboard/shops/{id}' , [OwnerShopController::class, 'update'])->name('owner_workshops_update');
    Route::delete('/dashboard/shops/{id}' , [OwnerShopController::class, 'destroy'])->name('owner_workshops_destroy');

    Route::get('/dashboard/shops/{workshopId}/services' , [OwnerServiceController::class, 'index'])->name('owner_services_index');
    Route::get('/dashboard/shops/{workshopId}/services/create' , [OwnerServiceController::class, 'create'])->name('owner_services_create');
    Route::post('/dashboard/shops/{workshopId}/services', [OwnerServiceController::class, 'store'])->name('owner_services_store');
    ROute::get('/dashboard/shops/{workshopId}/services/{serviceId}/edit' , [OwnerServiceController::class, 'edit'])->name('owner_services_edit');
    Route::put('/dashboard/shops/{workshopId}/services/{serviceId}', [OwnerServiceController::class, 'update'])->name('owner_services_update');
    Route::delete('/dashboard/shops/{workshopId}/services/{serviceId}', [OwnerServiceController::class, 'destroy'])->name('owner_services_destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
