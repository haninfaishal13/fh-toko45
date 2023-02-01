<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backsite\CategoryController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\ProductController;
use App\Http\Controllers\Backsite\TransactionController as BacksiteTransactionController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\Frontsite\ProductController as FrontsiteProductController;
use App\Http\Controllers\Frontsite\TransactionController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(['prefix' => 'filter'], function() {
        Route::get('select-category-toko', [FilterController::class, 'selectCategoryToko'])->name('filter.select-category.toko');
        Route::get('select-product', [FilterController::class, 'selectProduct'])->name('filter.select-product');
    });

    Route::group(['prefix' => 'backsite'], function() {
        Route::group(['prefix' => 'dashboard'], function() {
            Route::get('/', [DashboardController::class, 'index'])->name('backsite.dashboard');
            Route::get('getData', [DashboardController::class, 'getData'])->name('backsite.dashboard.getData');
            Route::get('getStatistic', [DashboardController::class, 'getStatistic'])->name('backsite.dashboard.getStatistic');
        });
        Route::group(['prefix' => 'category'], function() {
            Route::get('', [CategoryController::class, 'index'])->name('backsite.category');
        });
        Route::group(['prefix' => 'product'], function() {
            Route::get('', [ProductController::class, 'index'])->name('backsite.product');
            Route::post('', [ProductController::class, 'store'])->name('backsite.product.store');
            Route::get('create', [ProductController::class, 'create'])->name('backsite.product.create');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('backsite.product.edit');
            Route::put('update/{id}', [ProductController::class, 'update'])->name('backsite.product.update');
            Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('backsite.product.delete');
            Route::delete('image/delete/{id}', [ProductController::class, 'destroyImage'])->name('backsitte.product.image.delete');
            Route::post('import', [Productcontroller::class, 'import'])->name('backsite.product.import');

            Route::get('datacard', [ProductController::class, 'datacard'])->name('backsite.product.datacard');
            Route::get('showdata/{id}', [ProductController::class, 'showdata'])->name('backsite.product.showdata');
        });
        Route::group(['prefix' => 'transaction'], function() {
            Route::get('', [BacksiteTransactionController::class, 'index'])->name('backsite.transaction');
            Route::get('getData', [BacksiteTransactionController::class, 'getData']);
        });

    });

    Route::group(['prefix' => 'transaction'], function() {
        Route::get('/', [TransactionController::class, 'index'])->name('frontsite.transaction');
        Route::post('', [TransactionController::class, 'store'])->name('frontsite.transaction.store');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('getData', [FrontsiteProductController::class, 'getData'])->name('frontsite.product.getdata');
    });
});
