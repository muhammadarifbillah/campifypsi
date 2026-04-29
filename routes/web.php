<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ChatbotController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pembeli\PembeliArticleController;
use App\Http\Controllers\Pembeli\PembeliAuthController;
use App\Http\Controllers\Pembeli\PembeliCartController;
use App\Http\Controllers\Pembeli\PembeliCheckoutController;
use App\Http\Controllers\Pembeli\PembeliDashboardController;
use App\Http\Controllers\Pembeli\PembeliHomeController;
use App\Http\Controllers\Pembeli\PembeliOrderController;
use App\Http\Controllers\Pembeli\PembeliProductController;
use App\Http\Controllers\Pembeli\PembeliProfileController;
use App\Http\Controllers\Pembeli\PembeliReviewController;
use App\Http\Controllers\Pembeli\PembeliWishlistController;
use App\Http\Controllers\Pembeli\PembeliChatController;
use App\Http\Controllers\SellerController\AuthController_seller;
use App\Http\Controllers\SellerController\ChatController_seller;
use App\Http\Controllers\SellerController\DashboardController_seller;
use App\Http\Controllers\SellerController\OrderController_seller;
use App\Http\Controllers\SellerController\ProductController_seller;
use App\Http\Controllers\SellerController\RatingController_seller;
use App\Http\Controllers\SellerController\RentalController_seller;
use App\Http\Controllers\SellerController\StoreProfileController_seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            default => redirect()->route('buyer.dashboard'),
        };
    }

    return redirect()->route('login');
});

Route::get('/home', [PembeliHomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [PembeliAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [PembeliAuthController::class, 'register']);
Route::get('/seller/register', [AuthController_seller::class, 'registerForm'])->name('seller.register');
Route::post('/seller/register', [AuthController_seller::class, 'register'])->name('seller.register.store');

Route::get('/forgot-password', [PembeliAuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [PembeliAuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PembeliAuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [PembeliAuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{id}/activate', [UserController::class, 'activate'])->name('admin.users.activate');
    Route::get('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::get('/users/{id}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/approve/{id}', [ProductController::class, 'approve'])->name('admin.products.approve');
    Route::get('/products/reject/{id}', [ProductController::class, 'reject'])->name('admin.products.reject');
    Route::get('/products-list', [ProductController::class, 'list'])->name('admin.products.list');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');

    Route::get('/stores', [StoreController::class, 'index'])->name('admin.stores.index');
    Route::get('/stores/{id}', [StoreController::class, 'show'])->name('admin.stores.show');
    Route::post('/stores/{id}/approve', [StoreController::class, 'approve'])->name('admin.stores.approve');
    Route::post('/stores/{id}/reject', [StoreController::class, 'reject'])->name('admin.stores.reject');
    Route::post('/stores/{id}/suspend', [StoreController::class, 'suspend'])->name('admin.stores.suspend');
    Route::post('/stores/{id}/ban', [StoreController::class, 'ban'])->name('admin.stores.ban');
    Route::post('/stores/{id}/activate', [StoreController::class, 'activate'])->name('admin.stores.activate');
    Route::get('/stores/ban/{id}', [StoreController::class, 'banLegacy'])->name('admin.stores.ban-legacy');
    Route::get('/stores/unban/{id}', [StoreController::class, 'unban'])->name('admin.stores.unban');

    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::post('/articles/update/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::get('/articles/delete/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    Route::get('/articles/show/{id}', [ArticleController::class, 'show'])->name('admin.articles.show');
    Route::get('/articles/publish/{id}', [ArticleController::class, 'publish'])->name('admin.articles.publish');
    Route::get('/articles/unpublish/{id}', [ArticleController::class, 'unpublish'])->name('admin.articles.unpublish');

    Route::get('/couriers', [CourierController::class, 'index'])->name('admin.couriers.index');
    Route::post('/couriers/store', [CourierController::class, 'store'])->name('admin.couriers.store');
    Route::get('/couriers/edit/{id}', [CourierController::class, 'edit'])->name('admin.couriers.edit');
    Route::post('/couriers/update/{id}', [CourierController::class, 'update'])->name('admin.couriers.update');
    Route::get('/couriers/delete/{id}', [CourierController::class, 'destroy'])->name('admin.couriers.destroy');

    Route::get('/chats', [ChatController::class, 'index'])->name('admin.chats.index');
    Route::get('/chats/flag/{id}', [ChatController::class, 'flag'])->name('admin.chats.flag');

    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('admin.chatbot.index');
    Route::post('/chatbot/store', [ChatbotController::class, 'store'])->name('admin.chatbot.store');

    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring.index');
});

Route::get('/article/{id}', [PembeliArticleController::class, 'show'])->name('articles.show');
Route::get('/articles', [PembeliArticleController::class, 'index'])->name('articles.index');
Route::post('/review', [PembeliReviewController::class, 'store'])->name('review.store');

Route::get('/products/beli', [PembeliProductController::class, 'index'])->name('produk.index');
Route::get('/products/rental', [PembeliProductController::class, 'rentalProducts'])->name('produk.rental');
Route::get('/search', [PembeliProductController::class, 'search'])->name('produk.search');
Route::get('/product/{id}/buy', [PembeliProductController::class, 'detailBuy'])->name('produk.detail.buy');
Route::get('/product/{id}/rent', [PembeliProductController::class, 'detailRent'])->name('produk.detail.rent');
Route::get('/product/{id}', [PembeliProductController::class, 'detail'])->name('produk.detail');
Route::get('/category/{category}', [PembeliProductController::class, 'category'])->name('produk.category');
Route::get('/sewa/form/{id}', [PembeliProductController::class, 'formSewa'])->name('sewa.form');
Route::post('/sewa/process', [PembeliProductController::class, 'processSewa'])->name('sewa.process');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [PembeliDashboardController::class, 'index'])->name('buyer.dashboard');

    Route::get('/cart', [PembeliCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [PembeliCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [PembeliCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [PembeliCartController::class, 'remove'])->name('cart.remove');

    Route::get('/wishlist', [PembeliWishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [PembeliWishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::get('/checkout', [PembeliCheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/{id}', [PembeliCheckoutController::class, 'produk'])->name('checkout.now');
    Route::post('/checkout/process', [PembeliCheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/profile', [PembeliProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [PembeliProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/address', [PembeliProfileController::class, 'updateAddress'])->name('profile.address.update');
    Route::post('/profile/password', [PembeliProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/orders', [PembeliOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [PembeliOrderController::class, 'detail'])->name('orders.detail');
    Route::get('/orders/return/{detail_id}', [PembeliOrderController::class, 'returnForm'])->name('orders.return');
    Route::post('/orders/{id}/cancel', [PembeliOrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('/chat', [PembeliChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [PembeliChatController::class, 'send'])->name('chat.send');
});

Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [DashboardController_seller::class, 'index'])->name('seller.dashboard');

    Route::resource('/products', ProductController_seller::class)->names('seller.products');

    Route::get('/orders', [OrderController_seller::class, 'index'])->name('seller.orders.index');
    Route::get('/orders/{order}', [OrderController_seller::class, 'show'])->name('seller.orders.show');
    Route::get('/orders/{order}/edit', [OrderController_seller::class, 'edit'])->name('seller.orders.edit');
    Route::put('/orders/{order}', [OrderController_seller::class, 'update'])->name('seller.orders.update');
    Route::post('/orders/{order}/update-status', [OrderController_seller::class, 'updateStatus'])->name('seller.orders.updateStatus');

    Route::get('/rentals', [RentalController_seller::class, 'index'])->name('seller.rentals.index');
    Route::get('/rentals/{rental}', [RentalController_seller::class, 'show'])->name('seller.rentals.show');
    Route::get('/rentals/{rental}/edit', [RentalController_seller::class, 'edit'])->name('seller.rentals.edit');
    Route::put('/rentals/{rental}', [RentalController_seller::class, 'update'])->name('seller.rentals.update');

    Route::get('/store-profile', [StoreProfileController_seller::class, 'index'])->name('seller.store-profile.index');
    Route::get('/store-profile/show', [StoreProfileController_seller::class, 'show'])->name('seller.store-profile.show');
    Route::post('/store-profile', [StoreProfileController_seller::class, 'update'])->name('seller.store-profile.update');

    Route::get('/chat', [ChatController_seller::class, 'index'])->name('seller.chat.index');
    Route::get('/chat/{userId}', [ChatController_seller::class, 'show'])->name('seller.chat.show');
    Route::post('/chat', [ChatController_seller::class, 'store'])->name('seller.chat.store');

    Route::get('/ratings', [RatingController_seller::class, 'index'])->name('ratings.index');
    Route::post('/ratings/product', [RatingController_seller::class, 'storeProductRating'])->name('ratings.product');
    Route::post('/ratings/store', [RatingController_seller::class, 'storeStoreRating'])->name('ratings.store');
    Route::get('/ratings/product/{productId}', [RatingController_seller::class, 'getProductRatings'])->name('ratings.product.show');
    Route::get('/ratings/store/{storeId}', [RatingController_seller::class, 'getStoreRatings'])->name('ratings.store.show');
});

Route::get('/images/{path}', function ($path) {
    $file = storage_path('app/public/images/' . $path);

    abort_if(! file_exists($file), 404);

    return response()->file($file, [
        'Access-Control-Allow-Origin' => '*',
    ]);
})->where('path', '.*');