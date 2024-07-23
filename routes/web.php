<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\front\FrontendCategoryController;
use App\Http\Controllers\front\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\front\FrontendProductController;
use App\Http\Controllers\front\FrontendAuthController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\ProfileController;
use App\Http\Controllers\front\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\front\TestimonialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/dashboard', DashboardController::class);
    
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('admin.transaksi');
    Route::post('/transaksi/update-shipping', [TransactionController::class, 'updateShipping'])->name('admin.transaksi.update-shipping');
    Route::get('/transaksi/{id}', [TransactionController::class, 'show'])->name('admin.transaksi.show');
    Route::get('/admin/reports/sales', [ReportController::class, 'salesReport'])->name('admin.reports.sales');
    Route::get('/admin/reports/stock', [ReportController::class, 'stockReport'])->name('admin.reports.stock');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/kategori', [FrontendCategoryController::class, 'index'])->name('frontend.categories.index');
Route::get('/produk', [FrontendProductController::class, 'index'])->name('frontend.product.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('frontend.product.show');
Route::get('/produk/kategori/{categoryId}', [FrontendProductController::class, 'productByCategory'])->name('frontend.by_category');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'showCart'])->name('show.cart');
Route::patch('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::delete('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout/placeOrder', [PaymentController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::match(['get', 'post'], '/payment/success', [PaymentController::class, 'success'])->name('payment.success');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/frontend-register', [FrontendAuthController::class, 'register'])->name('frontend.register');
Route::post('/frontend-login', [FrontendAuthController::class, 'login'])->name('frontend.login');
Route::post('/frontend-logout', [FrontendAuthController::class, 'logout'])->name('frontend.logout');
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/payment/retry', [PaymentController::class, 'retryPayment'])->name('payment.retry');
Route::get('/order/success', [PaymentController::class, 'success'])->name('order.success');
Route::get('/order-history', [PaymentController::class, 'orderHistory'])->name('order.history');


