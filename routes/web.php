<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

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
    return view('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index.dashboard');
    Route::get('/driver_index', [DashboardController::class, 'driver_index'])->name('driver.dashboard');

    // Admin Panel
    Route::get('/load-drivers', [DashboardController::class, 'loadDrivers']);
    Route::get('/load-customers', [DashboardController::class, 'loadCustomers']);
    Route::get('/load-products', [DashboardController::class, 'loadProducts']);

    // Drivers Panel
    Route::get('/load-customers-for-drivers', [DashboardController::class, 'loadCustomersForDrivers']);

    // Drivers 
    Route::post('/add-driver', [DriverController::class, 'addDriver']);
    Route::get('/driver/{id}', [DriverController::class, 'getDriver']);
    Route::put('/edit-driver/{id}', [DriverController::class, 'editDriver']);
    Route::delete('/delete-driver/{id}', [DriverController::class, 'deleteDriver']);
    
    // Customers
    Route::get('/get-drivers', [DashboardController::class, 'getDrivers']);
    Route::post('/add-customer', [CustomerController::class, 'addCustomer']);
    Route::get('/customer/{id}', [CustomerController::class, 'getCustomer']);
    Route::put('/edit-customer/{id}', [CustomerController::class, 'editCustomer']);
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'deleteCustomer']);

    // Products
    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::get('/product/{id}', [ProductController::class, 'getProduct']);
    Route::put('/edit-product/{id}', [ProductController::class, 'editProduct']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

    // Discount
    Route::get('/products', [ProductController::class, 'loadProductsForDiscount']);
    Route::post('/add-discount', [DiscountController::class, 'addDiscount']);

    // Orders
    Route::get('/order-products', [ProductController::class, 'loadProductsForOrders']);
    Route::get('/calculate-discounted-price', [DiscountController::class, 'finalCalculations']);
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
    Route::get('/view-cart', [CartController::class, 'viewCart'])->name('view-cart');
    Route::post('/confirm-cart', [CartController::class, 'confirmOrder'])->name('confirm-cart');;
    Route::post('/generate-pdf', [CartController::class, 'generatePDF'])->name('generate-pdf');
});
