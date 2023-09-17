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
use App\Http\Controllers\Api\RollUsersController;
use App\Http\Controllers\Api\ItemOrdersController;
use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\StoreHouseController;
use App\Http\Controllers\Api\TransprterController;
use App\Http\Controllers\Api\item_orderController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ItemDetailsController;
use App\Http\Controllers\Api\CategoryItemsController;
use App\Http\Controllers\Api\ItemDonationsController;
use App\Http\Controllers\Api\ScoutRegimentController;
use App\Http\Controllers\Api\DonationEntityController;
use App\Http\Controllers\Api\TransprterTypeController;
use App\Http\Controllers\Api\DonationDetalesController;
use App\Http\Controllers\Api\ScoutCommissionController;
use App\Http\Controllers\Api\OrderStoreHousesController;
use App\Http\Controllers\Api\StoreHouseOrdersController;
use App\Http\Controllers\Api\TransprterOrdersController;
use App\Http\Controllers\Api\order_store_houseController;
use App\Http\Controllers\Api\ItemAllItemDetailsController;
use App\Http\Controllers\Api\StoreHouseDonationsController;
use App\Http\Controllers\Api\UserAllDonationDetalesController;
use App\Http\Controllers\Api\DonationDetalesDonationsController;
use App\Http\Controllers\Api\TransprterTypeTransprtersController;
use App\Http\Controllers\Api\ScoutCommissionScoutRegimentsController;
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

        // Category Items
        Route::get('/categories/{category}/items', [
            CategoryItemsController::class,
            'index',
        ])->name('categories.items.index');
        Route::post('/categories/{category}/items', [
            CategoryItemsController::class,
            'store',
        ])->name('categories.items.store');

        Route::apiResource('donations', DonationController::class);

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

        // Item Donations
        Route::get('/items/{item}/donations', [
            ItemDonationsController::class,
            'index',
        ])->name('items.donations.index');
        Route::post('/items/{item}/donations', [
            ItemDonationsController::class,
            'store',
        ])->name('items.donations.store');

        // Item All Item Details
        Route::get('/items/{item}/all-item-details', [
            ItemAllItemDetailsController::class,
            'index',
        ])->name('items.all-item-details.index');
        Route::post('/items/{item}/all-item-details', [
            ItemAllItemDetailsController::class,
            'store',
        ])->name('items.all-item-details.store');

        // Item Orders
        Route::get('/items/{item}/orders', [
            ItemOrdersController::class,
            'index',
        ])->name('items.orders.index');
        Route::post('/items/{item}/orders/{order}', [
            ItemOrdersController::class,
            'store',
        ])->name('items.orders.store');
        Route::delete('/items/{item}/orders/{order}', [
            ItemOrdersController::class,
            'destroy',
        ])->name('items.orders.destroy');

        Route::apiResource('all-item-details', ItemDetailsController::class);

        Route::apiResource('orders', OrderController::class);

        // Order Items
        Route::get('/orders/{order}/items', [
            OrderItemsController::class,
            'index',
        ])->name('orders.items.index');
        Route::post('/orders/{order}/items/{item}', [
            OrderItemsController::class,
            'store',
        ])->name('orders.items.store');
        Route::delete('/orders/{order}/items/{item}', [
            OrderItemsController::class,
            'destroy',
        ])->name('orders.items.destroy');

        // Order Store Houses
        Route::get('/orders/{order}/store-houses', [
            OrderStoreHousesController::class,
            'index',
        ])->name('orders.store-houses.index');
        Route::post('/orders/{order}/store-houses/{storeHouse}', [
            OrderStoreHousesController::class,
            'store',
        ])->name('orders.store-houses.store');
        Route::delete('/orders/{order}/store-houses/{storeHouse}', [
            OrderStoreHousesController::class,
            'destroy',
        ])->name('orders.store-houses.destroy');

        Route::apiResource('rolls', RollController::class);

        // Roll Users
        Route::get('/rolls/{roll}/users', [
            RollUsersController::class,
            'index',
        ])->name('rolls.users.index');
        Route::post('/rolls/{roll}/users', [
            RollUsersController::class,
            'store',
        ])->name('rolls.users.store');

        Route::apiResource(
            'scout-commissions',
            ScoutCommissionController::class
        );

        // ScoutCommission Scout Regiments
        Route::get('/scout-commissions/{scoutCommission}/scout-regiments', [
            ScoutCommissionScoutRegimentsController::class,
            'index',
        ])->name('scout-commissions.scout-regiments.index');
        Route::post('/scout-commissions/{scoutCommission}/scout-regiments', [
            ScoutCommissionScoutRegimentsController::class,
            'store',
        ])->name('scout-commissions.scout-regiments.store');

        Route::apiResource('scout-regiments', ScoutRegimentController::class);

        Route::apiResource('store-houses', StoreHouseController::class);

        // StoreHouse Donations
        Route::get('/store-houses/{storeHouse}/donations', [
            StoreHouseDonationsController::class,
            'index',
        ])->name('store-houses.donations.index');
        Route::post('/store-houses/{storeHouse}/donations', [
            StoreHouseDonationsController::class,
            'store',
        ])->name('store-houses.donations.store');

        // StoreHouse Orders
        Route::get('/store-houses/{storeHouse}/orders', [
            StoreHouseOrdersController::class,
            'index',
        ])->name('store-houses.orders.index');
        Route::post('/store-houses/{storeHouse}/orders/{order}', [
            StoreHouseOrdersController::class,
            'store',
        ])->name('store-houses.orders.store');
        Route::delete('/store-houses/{storeHouse}/orders/{order}', [
            StoreHouseOrdersController::class,
            'destroy',
        ])->name('store-houses.orders.destroy');

        Route::apiResource('transprters', TransprterController::class);

        // Transprter Orders
        Route::get('/transprters/{transprter}/orders', [
            TransprterOrdersController::class,
            'index',
        ])->name('transprters.orders.index');
        Route::post('/transprters/{transprter}/orders', [
            TransprterOrdersController::class,
            'store',
        ])->name('transprters.orders.store');

        Route::apiResource('transprter-types', TransprterTypeController::class);

        // TransprterType Transprters
        Route::get('/transprter-types/{transprterType}/transprters', [
            TransprterTypeTransprtersController::class,
            'index',
        ])->name('transprter-types.transprters.index');
        Route::post('/transprter-types/{transprterType}/transprters', [
            TransprterTypeTransprtersController::class,
            'store',
        ])->name('transprter-types.transprters.store');

        Route::apiResource('users', UserController::class);

        // User All Donation Detales
        Route::get('/users/{user}/all-donation-detales', [
            UserAllDonationDetalesController::class,
            'index',
        ])->name('users.all-donation-detales.index');
        Route::post('/users/{user}/all-donation-detales', [
            UserAllDonationDetalesController::class,
            'store',
        ])->name('users.all-donation-detales.store');
    });
