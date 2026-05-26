<?php

use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\CarPostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// PUBLIC / EXISTING ROUTES (do not remove)
// ─────────────────────────────────────────────
Route::get('/signup', [UserController::class, 'showsignup'])->name('signupForm');
Route::post('/signup', [UserController::class, 'store'])->name('register');
Route::get('/login', [UserController::class, 'showlogin'])->name('loginForm');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/contact', fn() => view('contact'))->name('contact');

// ─────────────────────────────────────────────
// E-COMMERCE PUBLIC ROUTES
// ─────────────────────────────────────────────
// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product listing & detail (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES (requires login)
// ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Existing auth routes
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/category', [CarCategoryController::class, 'create'])->name('categoryPage');
    Route::post('/category', [CarCategoryController::class, 'store'])->name('category.create');
    Route::get('/post', [CarPostController::class, 'create'])->name('carPost');
    Route::post('/post', [CarPostController::class, 'store'])->name('post.create');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/post/{id}/edit', [CarPostController::class, 'edit'])->name('editForm');
    Route::put('/post/{id}', [CarPostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [CarPostController::class, 'destroy'])->name('postDelete');
    Route::post('/post/{id}/like', [CarPostController::class, 'toggleLike'])->name('post.like');
    Route::post('/player', [PlayersController::class, 'store'])->name('players.store');
    Route::get('/player/{player}/edit', [PlayersController::class, 'edit'])->name('players.edit');
    Route::put('/player/{player}', [PlayersController::class, 'update'])->name('players.update');
    Route::get('/players/create', [PlayersController::class, 'create'])->name('players.create');
    Route::delete('/player/{player}', [PlayersController::class, 'destroy'])->name('players.destroy');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout & Orders
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/player', [PlayersController::class, 'create'])->name('players.create');

// ─────────────────────────────────────────────
// ADMIN ROUTES (requires login + admin role)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products management
    Route::resource('products', AdminProductController::class);

    // Categories management
    Route::resource('categories', AdminCategoryController::class);

    // Orders management
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
});
