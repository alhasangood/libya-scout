<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\StoreHouseController;
use App\Http\Controllers\TransprterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ItemDetailsController;
use App\Http\Controllers\ScoutRegimentController;
use App\Http\Controllers\DonationEntityController;
use App\Http\Controllers\TransprterTypeController;
use App\Http\Controllers\DonationDetalesController;
use App\Http\Controllers\ScoutCommissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('categories', CategoryController::class);
        Route::resource('donations', DonationController::class);
        Route::get('all-donation-detales', [
            DonationDetalesController::class,
            'index',
        ])->name('all-donation-detales.index');
        Route::post('all-donation-detales', [
            DonationDetalesController::class,
            'store',
        ])->name('all-donation-detales.store');
        Route::get('all-donation-detales/create', [
            DonationDetalesController::class,
            'create',
        ])->name('all-donation-detales.create');
        Route::get('all-donation-detales/{donationDetales}', [
            DonationDetalesController::class,
            'show',
        ])->name('all-donation-detales.show');
        Route::get('all-donation-detales/{donationDetales}/edit', [
            DonationDetalesController::class,
            'edit',
        ])->name('all-donation-detales.edit');
        Route::put('all-donation-detales/{donationDetales}', [
            DonationDetalesController::class,
            'update',
        ])->name('all-donation-detales.update');
        Route::delete('all-donation-detales/{donationDetales}', [
            DonationDetalesController::class,
            'destroy',
        ])->name('all-donation-detales.destroy');

        Route::resource('donation-entities', DonationEntityController::class);
        Route::resource('items', ItemController::class);
        Route::get('all-item-details', [
            ItemDetailsController::class,
            'index',
        ])->name('all-item-details.index');
        Route::post('all-item-details', [
            ItemDetailsController::class,
            'store',
        ])->name('all-item-details.store');
        Route::get('all-item-details/create', [
            ItemDetailsController::class,
            'create',
        ])->name('all-item-details.create');
        Route::get('all-item-details/{itemDetails}', [
            ItemDetailsController::class,
            'show',
        ])->name('all-item-details.show');
        Route::get('all-item-details/{itemDetails}/edit', [
            ItemDetailsController::class,
            'edit',
        ])->name('all-item-details.edit');
        Route::put('all-item-details/{itemDetails}', [
            ItemDetailsController::class,
            'update',
        ])->name('all-item-details.update');
        Route::delete('all-item-details/{itemDetails}', [
            ItemDetailsController::class,
            'destroy',
        ])->name('all-item-details.destroy');

        Route::resource('orders', OrderController::class);
        Route::resource('rolls', RollController::class);
        Route::resource('scout-commissions', ScoutCommissionController::class);
        Route::resource('scout-regiments', ScoutRegimentController::class);
        Route::resource('store-houses', StoreHouseController::class);
        Route::resource('transprters', TransprterController::class);
        Route::resource('transprter-types', TransprterTypeController::class);
        Route::resource('users', UserController::class);
    });
