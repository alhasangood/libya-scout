<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\RollController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\StoreHouseController;
use App\Http\Controllers\Api\TransprterController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ItemDetailsController;
use App\Http\Controllers\Api\ScoutRegimentController;
use App\Http\Controllers\Api\DonationEntityController;
use App\Http\Controllers\Api\ItemCategoriesController;
use App\Http\Controllers\Api\OrderDonationsController;
use App\Http\Controllers\Api\TransprterTypeController;
use App\Http\Controllers\Api\DonationDetalesController;
use App\Http\Controllers\Api\ScoutCommissionController;
use App\Http\Controllers\Api\StoreHouseItemsController;
use App\Http\Controllers\Api\OrderTransprtersController;
use App\Http\Controllers\Api\DonationCategoriesController;
use App\Http\Controllers\Api\ItemAllItemDetailsController;
use App\Http\Controllers\Api\OrderScoutRegimentsController;
use App\Http\Controllers\Api\OrderScoutCommissionsController;
use App\Http\Controllers\Api\DonationDetalesDonationsController;
use App\Http\Controllers\Api\TransprterTransprterTypesController;
use App\Http\Controllers\Api\DonationEntityAllDonationDetalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('donations', DonationController::class);

        // Donation Categories
        Route::get('/donations/{donation}/categories', [
            DonationCategoriesController::class,
            'index',
        ])->name('donations.categories.index');
        Route::post('/donations/{donation}/categories', [
            DonationCategoriesController::class,
            'store',
        ])->name('donations.categories.store');

        Route::apiResource(
            'all-donation-detales',
            DonationDetalesController::class
        );

        // DonationDetales Donations
        Route::get('/all-donation-detales/{donationDetales}/donations', [
            DonationDetalesDonationsController::class,
            'index',
        ])->name('all-donation-detales.donations.index');
        Route::post('/all-donation-detales/{donationDetales}/donations', [
            DonationDetalesDonationsController::class,
            'store',
        ])->name('all-donation-detales.donations.store');

        Route::apiResource(
            'donation-entities',
            DonationEntityController::class
        );

        // DonationEntity All Donation Detales
        Route::get('/donation-entities/{donationEntity}/all-donation-detales', [
            DonationEntityAllDonationDetalesController::class,
            'index',
        ])->name('donation-entities.all-donation-detales.index');
        Route::post(
            '/donation-entities/{donationEntity}/all-donation-detales',
            [DonationEntityAllDonationDetalesController::class, 'store']
        )->name('donation-entities.all-donation-detales.store');

        Route::apiResource('items', ItemController::class);

        // Item Categories
        Route::get('/items/{item}/categories', [
            ItemCategoriesController::class,
            'index',
        ])->name('items.categories.index');
        Route::post('/items/{item}/categories', [
            ItemCategoriesController::class,
            'store',
        ])->name('items.categories.store');

        // Item All Item Details
        Route::get('/items/{item}/all-item-details', [
            ItemAllItemDetailsController::class,
            'index',
        ])->name('items.all-item-details.index');
        Route::post('/items/{item}/all-item-details', [
            ItemAllItemDetailsController::class,
            'store',
        ])->name('items.all-item-details.store');

        Route::apiResource('all-item-details', ItemDetailsController::class);

        Route::apiResource('orders', OrderController::class);

        // Order Scout Commissions
        Route::get('/orders/{order}/scout-commissions', [
            OrderScoutCommissionsController::class,
            'index',
        ])->name('orders.scout-commissions.index');
        Route::post('/orders/{order}/scout-commissions', [
            OrderScoutCommissionsController::class,
            'store',
        ])->name('orders.scout-commissions.store');

        // Order Scout Regiments
        Route::get('/orders/{order}/scout-regiments', [
            OrderScoutRegimentsController::class,
            'index',
        ])->name('orders.scout-regiments.index');
        Route::post('/orders/{order}/scout-regiments', [
            OrderScoutRegimentsController::class,
            'store',
        ])->name('orders.scout-regiments.store');

        // Order Transprters
        Route::get('/orders/{order}/transprters', [
            OrderTransprtersController::class,
            'index',
        ])->name('orders.transprters.index');
        Route::post('/orders/{order}/transprters', [
            OrderTransprtersController::class,
            'store',
        ])->name('orders.transprters.store');

        // Order Donations
        Route::get('/orders/{order}/donations', [
            OrderDonationsController::class,
            'index',
        ])->name('orders.donations.index');
        Route::post('/orders/{order}/donations', [
            OrderDonationsController::class,
            'store',
        ])->name('orders.donations.store');

        Route::apiResource('rolls', RollController::class);

        Route::apiResource(
            'scout-commissions',
            ScoutCommissionController::class
        );

        Route::apiResource('scout-regiments', ScoutRegimentController::class);

        Route::apiResource('store-houses', StoreHouseController::class);

        // StoreHouse Items
        Route::get('/store-houses/{storeHouse}/items', [
            StoreHouseItemsController::class,
            'index',
        ])->name('store-houses.items.index');
        Route::post('/store-houses/{storeHouse}/items', [
            StoreHouseItemsController::class,
            'store',
        ])->name('store-houses.items.store');

        Route::apiResource('transprters', TransprterController::class);

        // Transprter Transprter Types
        Route::get('/transprters/{transprter}/transprter-types', [
            TransprterTransprterTypesController::class,
            'index',
        ])->name('transprters.transprter-types.index');
        Route::post('/transprters/{transprter}/transprter-types', [
            TransprterTransprterTypesController::class,
            'store',
        ])->name('transprters.transprter-types.store');

        Route::apiResource('transprter-types', TransprterTypeController::class);

        Route::apiResource('users', UserController::class);
    });
