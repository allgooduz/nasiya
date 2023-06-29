<?php

use App\Http\Controllers\FinancesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UzCardApi\UzcardController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/locale/{lang}', [LocalizationController::class, 'setLang'])->name('lang');

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/shops', [PagesController::class, 'shops'])->name('shops');
Auth::routes();

Route::prefix('uzcard')->group( function(){
    Route::get('/createusercard', [UzcardController::class, 'createUserCard'])->name('createUserCard');
    Route::get('/deleteusercard', [UzcardController::class, 'deleteUserCard'])->name('deleteUserCard');
});

Route::redirect('merchant', 'merchant/orders');

Route::prefix('merchant')->group(function () {
    Route::group(['middleware' => ['auth']], function() {
        // FINANCE
        Route::get('/finance', [FinancesController::class, 'index'])->name('finance');

        // SCORING
        Route::get('/scoring', [PagesController::class, 'scoring'])->name('scoring');

        // CREATING NEW ORDER
        Route::get('/clientorder/phone', [PagesController::class, 'clientorderPhone'])->name('clientorder.phone');
        Route::get('/clientorder/show', [PagesController::class, 'clientorderShow'])->name('clientorder.show');

        // MYCLIENTS
        Route::get('/myclients', [PagesController::class, 'myclients'])->name('myclients');

        // ORDERS
        Route::get('/orders/{filterStatus?}/{date?}', [OrdersController::class, 'orders'])->name('orders');
        Route::post('/orders', [OrdersController::class, 'ordersByDate'])->name('ordersByDate');
        Route::get('/order/{id}', [OrdersController::class, 'order'])->name('order');

        // PRODUCTS
        Route::get('/products', [ProductsController::class, 'products'])->name('products');
        Route::get('/product/{id}', [ProductsController::class, 'product'])->name('product');
        Route::get('/product/add', [ProductsController::class, 'add_product'])->name('product.add');
        Route::post('/excel/products', [ProductsController::class, 'excelProducts'])->name('excel.products');
        Route::post('/excelget/productsget', [ProductsController::class, 'excelgetProductsget'])->name('excelget.productsget');

        Route::post('/delete/product', [ProductsController::class, 'delete'])->name('product.delete');
        Route::post('/update/product/active', [ProductsController::class, 'updateActive'])->name('product.update.active');
        Route::post('/update/product/unactive', [ProductsController::class, 'updateUnactive'])->name('product.update.unactive');

        Route::put('/update/product/{id}', [ProductsController::class, 'update'])->name('product.update');
    });
});


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

